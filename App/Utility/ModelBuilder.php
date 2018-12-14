<?php
/**
 * Created by PhpStorm.
 * User: eValor
 * Date: 2018/11/10
 * Time: 上午1:52
 */

namespace App\Utility;

use App\Utility\Pool\MysqlDbObject;
use App\Utility\Pool\MysqlPoolObject;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Utility\Str;
use Nette\PhpGenerator\PhpNamespace;

/**
 * 模型快速构建器
 * Class ModelBuilder
 * @package App\Utility
 */
class ModelBuilder
{
    protected $basePath;
    protected $nameType=1;

    /**
     * ModelBuilder constructor.
     * @param string $baseDirectory 请使用绝对地址
     * @throws \Exception
     */
    public function __construct($baseDirectory,$type=1)
    {
        $this->basePath = $baseDirectory;
        $this->createBaseDirectory($baseDirectory);
    }

    /**
     * 创建模型存放目录
     * @param $baseDirectory
     * @author: eValor < master@evalor.cn >
     * @throws \Exception
     */
    protected function createBaseDirectory($baseDirectory)
    {
        if (!is_dir((string)$baseDirectory)) {
            if (!@mkdir($baseDirectory, 0755)) throw new \Exception("Failed to create directory {$baseDirectory}");
            @chmod($baseDirectory, 0755);  // if umask
            if (!is_writable($baseDirectory)) {
                throw new \Exception("The directory {$baseDirectory} cannot be written. Please set the permissions manually");
            }
        }
    }

    /**
     * 创建基础模型
     * @param string $baseNamespace 基础命名空间
     * @param string $fileName 文件名
     * @author: eValor < master@evalor.cn >
     */
    public function buildBase($baseNamespace, $fileName)
    {
        if (strpos($fileName, '.php')) {
            $realFileName = ucfirst(str_replace('.php', '', $fileName));
        } else {
            $realFileName = ucfirst($fileName);
        }
        $phpNamespace = new PhpNamespace($baseNamespace);
        $phpClass = $phpNamespace->addClass($realFileName);
        $phpClass->addComment("Class {$realFileName}");
        $phpClass->addComment('Create With Automatic Generator');
        $this->createPHPDocument($this->basePath . '/' . $fileName, $phpNamespace);
    }

    /**
     * 以数据库名称创建全部模型
     * @param $dbName
     * @param $baseNamespace
     * @param $baseModelName
     * @param string $tablePre
     * @throws \EasySwoole\Mysqli\Exceptions\ConnectFail
     * @throws \EasySwoole\Mysqli\Exceptions\PrepareQueryFail
     * @throws \Exception
     * @author: eValor < master@evalor.cn >
     */
    public function buildFromDbName($dbName, $baseNamespace, $baseModelName, $tablePre = '')
    {
        $db = $this->createDbInstance();
        $schema = $db->rawQuery("SELECT * FROM information_schema.SCHEMATA where SCHEMA_NAME='{$dbName}';");
        if (empty($schema)) {
            throw new \Exception("the database {$dbName} does not exists.");
        }

        // search tables
        $db->getMysqlClient()->query("use {$dbName};");
        $tables = array_column($db->rawQuery("show tables;"), "Tables_in_{$dbName}");

        // build the tables
        foreach ($tables as $tableName) {
            $realTableName = $tableName;
            if ($tablePre !== '' && Str::startsWith($tableName, $tablePre)) {
                $realTableName = ucfirst(Str::camel(substr($tableName, strlen($tablePre))));
            }
            $tableComment = $db->rawQuery("select TABLE_COMMENT from information_schema.TABLES WHERE TABLE_NAME = '{$tableName}' AND TABLE_SCHEMA = '{$dbName}'")[0]['TABLE_COMMENT'];
            $tableColumns = $db->rawQuery("show full columns from {$tableName}");

            $phpNamespace = new PhpNamespace($baseNamespace);
            $phpClass = $phpNamespace->addClass($realTableName);
            $phpClass->addExtend("$baseNamespace\\$baseModelName");
            $phpClass->addComment("{$tableComment}");
            $phpClass->addComment("Class {$realTableName}");
            $phpClass->addComment('Create With Automatic Generator');
            foreach ($tableColumns as $column) {
                $name = $column['Field'];
                $comment = $column['Comment'];
                $columnType = $this->convertDbTypeToDocType($column['Type']);
                $phpClass->addComment("@property {$columnType} {$name} | {$comment}");
                $phpClass->addProperty('table', $tableName);
            }
            $this->createPHPDocument($this->basePath . '/' . $realTableName, $phpNamespace);
        }
    }

    /**
     * 获取一个Db实例
     * @return MysqlPoolObject
     * @author: eValor < master@evalor.cn >
     */
    protected function createDbInstance()
    {
        $dbConfig = new \EasySwoole\Mysqli\Config(Config::getInstance()->getConf('MYSQL'));
        return new MysqlDbObject($dbConfig);
    }

    /**
     * 将数据库的类型转换为PHPDocument类型
     * @param $fieldType
     * @author: eValor < master@evalor.cn >
     * @return string
     */
    protected function convertDbTypeToDocType($fieldType)
    {
        $newFieldType = strtolower(strstr($fieldType, '(', true));
        if ($newFieldType == '') $newFieldType = strtolower($fieldType);
        if (in_array($newFieldType, [ 'tinyint', 'smallint', 'mediumint', 'int', 'bigint' ])) {
            $newFieldType = 'int';
        } elseif (in_array($newFieldType, [ 'float', 'double', 'real', 'decimal', 'numeric' ])) {
            $newFieldType = 'float';
        } elseif (in_array($newFieldType, [ 'char', 'varchar', 'text' ])) {
            $newFieldType = 'string';
        } else {
            $newFieldType = 'mixed';
        }
        return $newFieldType;
    }

    /**
     * 写出到PHP文件中
     * @param string $fileName
     * @param string $fileContent
     * @return bool|int
     * @author: eValor < master@evalor.cn >
     */
    protected function createPHPDocument($fileName, $fileContent)
    {
        $content = "<?php\n\n{$fileContent}\n";
        return file_put_contents($fileName . '.php', $content);
    }
}
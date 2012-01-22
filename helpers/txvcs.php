<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elkuku
 * Date: 21.01.12
 * Time: 23:23
 * To change this template use File | Settings | File Templates.
 */

class TxVcsHelper
{
    public static function getHeader($path)
    {
        if( ! file_exists($path))
            throw new DomainException(__METHOD__.' - File not found: '.$path);

        $contents = file($path);

        $header = '';

        foreach($contents as $line)
        {
            if( ! trim($line))
                break;

            $header .= $line;
        }

        return $header;
    }

    public static function readFile($project, $resource, $lang, $type)
    {
        $path = self::getFilePath($project, $resource, $lang, $type);

        if( ! file_exists($path))
            throw new DomainException(__METHOD__.' - File not found: '.$path);

        $result = new stdClass;
        $result->header = self::getHeader($path);

        $result->strings = parse_ini_file($path);
        $result->path = $path;

        return $result;
    }

    public static function writeFile($fileInfo)
    {
        $contents = $fileInfo->header."\n";

        foreach($fileInfo->strings as $key => $value)
        {
            //-- God bless the QQs
            $value = str_replace('"', '"_QQ_"', $value);

            $contents .= $key.'="'.$value.'"'."\n";
        }

        if( ! JFile::write($fileInfo->path.'.xx', $contents))
        {
            throw new DomainException('Can not write to file: '.$fileInfo->path);
        }
    }

    public static function getFilePath($project, $resource, $lang, $type)
    {
        switch($type)
        {
            case 'tx' :
                $path = JPATH_BASE.'/'.$project->tx_path.'/'.$resource->tx_rel_path.'/'.$resource->filename;

                break;

            case 'vcs' :
                $path = JPATH_BASE.'/'.$project->vcs_path.'/'.$resource->vcs_rel_path.'/'.$resource->filename;

                break;

            default :
                throw new BadMethodCallException(__METHOD__.' - Unknown type '.$type);
                break;
        }

        return str_replace('[lang]', $lang, $path);
    }
}

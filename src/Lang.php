<?php

use Lang\Map;
use System\Hub\Singleton;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
final class Lang
{
    use Singleton;

    /**
     * @var string
     */
    private $lang;

    /**
     * Constructor.
     * @param string $lang
     */
    public function __construct($lang)
    {
        if (isset(Map::$lang[$lang])) {
            $this->lang = Map::$lang[$lang];
        } else {
            throw new LanguageNotFoundException("Language '{$lang}' not found!", 101);
        }
    }
    
    public static function init($lang)
    {
        self::$instance = new self($lang);
    }

    public static function system($gt)
    {
        return (self::getInstance()->lang."System")::$sys[$gt];
    }
}

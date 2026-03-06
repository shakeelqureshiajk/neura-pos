<?php
namespace App\Enums;

enum Language:int{
    /**
     * Where, Id's Indicates
     * 1 = en = English
     * 2 = ur = Urdu
     * 3 = ar = Arabic
     * 4 = hi = Hindi
     * */
    case ENGLISH = 1;
    case URDU = 2;
    case ARABIC = 3;
    case HINDI = 4;
}

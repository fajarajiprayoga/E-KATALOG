<?php

class LevelLookUp{

      const ADM  = "10";
      const SALES = "20";
      const ENG  = "30";
      const ALL  = "40";

      // For CGridView, CListView Purposes

      public static function getLabel( $level ){

          if($level == self::ADM)

             return 'Adm';
          
          if($level == self::ENG)

             return 'Eng';
          
          if($level == self::SALES)

             return 'Sales';
          
          if($level == self::ALL)

             return 'All';

          return false;

      }

      // for dropdown lists purposes

      public static function getLevelList(){

          return array(

                 self::ADM=>'Adm',
                 self::ENG=>'Eng',
                 self::SALES=>'Sales',
                 self::ALL=>'All');

      }

}

?>
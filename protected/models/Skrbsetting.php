<?php



/**

* This is the model class for table "users".

*

* The followings are the available columns in table 'users':

* @property integer $id

* @property string $username

* @property string $password

* @property integer $level

*/

class Skrbsetting extends CActiveRecord

{



public function tableName()

{

return 'SKRBFILE_USER_SETTING';

}





        public static function a()

	{

		return array(

			'1' => 'Eng_s'

		);

	}

/**

* @return array validation rules for model attributes.

*/

public function rules()

{

}



/**

* @return array relational rules.

*/

public function relations()

{

// NOTE: you may need to adjust the relation name and the related

// class name for the relations automatically generated below.

return array(

);

}



/**

* @return array customized attribute labels (name=>label)

*/

public function attributeLabels()

{

return array(


);

}



/**

* Retrieves a list of models based on the current search/filter conditions.

*

* Typical usecase:

* - Initialize the model fields with values from filter form.

* - Execute this method to get CActiveDataProvider instance which will filter

* models according to data in model fields.

* - Pass data provider to CGridView, CListView or any similar widget.

*

* @return CActiveDataProvider the data provider that can return the models

* based on the search/filter conditions.

*/

public function search()

{

// @todo Please modify the following code to remove attributes that should not be searched.



$criteria=new CDbCriteria;


$criteria->compare('status',$this->STATUS);



return new CActiveDataProvider($this, array(

'criteria'=>$criteria,

));

}



/**

* Returns the static model of the specified AR class.

* Please note that you should have this exact method in all your CActiveRecord descendants!

* @param string $className active record class name.

* @return User the static model class

*/

public static function model($className=__CLASS__)

{

return parent::model($className);

}

}
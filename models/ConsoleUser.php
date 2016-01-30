<?php
namespace app\models;

use Yii;
use dektrium\user\models\User;
use yii\log\Logger;
use dektrium\user\models\Token;

class ConsoleUser extends User{
	public $code;
	public function register()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $this->confirmed_at = time();
        
        $this->trigger(self::BEFORE_REGISTER);

        if (!$this->save()) {
            return false;
        }
		
        $this->trigger(self::AFTER_REGISTER);

        return true;
    }

    public function attemptConfirmation($code)
    {
        /** @var Token $token */
        $token = $this->finder->findToken([
            'user_id' => $this->id,
            'code'    => $code,
            'type'    => Token::TYPE_CONFIRMATION,
        ])->one();

        if ($token !== null && !$token->isExpired){
            $token->delete();
    
            $this->confirmed_at = time();
    
            \Yii::getLogger()->log('User has been confirmed', Logger::LEVEL_INFO);
    
            $this->save(false);
        }
    }
}

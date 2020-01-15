<?php

namespace backend\models\form;

use Yii;
use yii\base\Model;
use backend\models\Judgement;
use backend\models\JudgementJudge;

class JudgementForm extends Model
{
    private $_judgement;
    private $_judge;

    public function rules()
    {
        return [
            [['Judgement'], 'required'],
            [['Judge'], 'safe'],
        ];
    }

    public function afterValidate()
    {
        $error = false;
        if (!$this->judgement->validate()) {
            $error = true;
        }
        if (!$this->judgementjudge->validate()) {
            $error = true;
        }
        if ($error) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->judgementjudge->save()) {
            $transaction->rollBack();
            return false;
        }
        $this->judge->judgement_id = $this->judgement->id;
        if (!$this->judgementjudge->save(false)) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }

    public function getJudgement()
    {
        return $this->_judgement;
    }

    public function setJudgement($judgement)
    {
        if ($judgement instanceof Judgement) {
            $this->_judgement = $judgement;
        } else if (is_array($judgement)) {
            $this->_judgement->setAttributes($judgement);
        }
    }

    public function getJudge()
    {
        if ($this->_judge === null) {
            if ($this->judgement->isNewRecord) {
                $this->_judge = new JudgementJudge();
                $this->_judge->loadDefaultValues();
            } else {
                $this->_judge = $this->judgement->judgementjudge;
            }
        }
        return $this->_judge;
    }

    public function setJudge($judge)
    {
        if (is_array($judge)) {
            $this->judgementjudge->setAttributes($judge);
        } elseif ($judge instanceof JudgementJudge) {
            $this->_judge = $judge;
        }
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels()
    {
        return [
            'Judgement' => $this->judgement,
            'Judge' => $this->judgementjudge,
        ];
    }
}

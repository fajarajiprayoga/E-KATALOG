<section class="py-5">
        <table style="width: 100%;">
            <?php if(Yii::app()->user->isAdm()) { ?>
                BERANDA ADMIN
            <?php } else if(Yii::app()->user->isEng()) { ?>
                BERANDA ENGINEERING
            <?php } else if(Yii::app()->user->isSales()) { ?>
                BERANDA SALES
            <?php } ?>
        </table>
</section>
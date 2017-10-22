<script>
    VK.callMethod("showAllowMessagesFromCommunityBox");
    VK.addCallback('onAllowMessagesFromCommunity', function f(e) {
        console.log(e);
        VK.api('messages.isMessagesFromGroupAllowed', {
            "group_id": <?= Yii::$app->user->identity->application->vk_group_id ?>,
            "user_id": <?= Yii::$app->user->identity->vk_user_id ?>
        }, function (data) {
            console.log(data);
        });
        VK.api("messages.send", {
            "user_id": "<?= Yii::$app->user->identity->vk_user_id ?>",
            "message": 'Hello!'
        }, function (data) {
            console.log(data);
        });
    });
</script>

<div>
    Здесь вы сможете выписать счет.
    <br>
    А пока Вы можете выбрать товар и начать беседу с нашим ботом.
</div>

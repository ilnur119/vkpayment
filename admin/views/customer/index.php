<script>
    VK.callMethod("showAllowMessagesFromCommunityBox");
    VK.addCallback('onAllowMessagesFromCommunity', function f(e) {
        console.log(e);
        VK.api("messages.send", {
            "user_id": <?= Yii::$app->user->identity->vk_user_id ?>,
            'message': 'Привет! Что тебя интересует?'
        }, function (data) {
            data = data.response;
            console.log(data);
        });
    });
</script>

<div>
    Здесь вы сможете выписать счет.
    <br>
    А пока Вы можете выбрать товар и начать беседу с нашим ботом.
</div>

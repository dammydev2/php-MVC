<div class="container" id="vapp">
    <div class="row">
        <div class="col-md-6">
            <h1>Добавить задачу</h1>

            <form action="#" method="post"  >
                <div class="form-group">
                    <label>Имя:</label>
                    <p><?= htmlentities($data['task']->name) ?></p>
                    <hr>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <p><?= htmlentities($data['task']->email) ?></p>
                    <hr>
                </div>
                <div class="form-group">
                    <label for="image">Картинка</label>
                    <img src="/<?= htmlentities($data['task']->image) ?>" style="max-width: 320px; max-height: 240px" >
                    <hr>
                </div>

                <div class="form-group">
                    <label for="text">Текст</label>
                    <textarea v-model="text" id="text" cols="30" rows="5" name="text" class="form-control" ></textarea>
                    <?php if (isset($data['errors']['text'])): ?>
                        <small id="textHelp" class="form-text text-muted alert-danger"><?= $data['errors']['text']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="status">Статус</label>
                    <select name="status" id="status" class="form-control" >
                        <option value="0" <?= $data['task']->status == 0 ? 'selected' : '' ?> >Новое</option>
                        <option value="1" <?= $data['task']->status == 1 ? 'selected' : '' ?> >Выполнено</option>
                    </select>
                    <?php if (isset($data['errors']['status'])): ?>
                        <small class="form-text text-muted alert-danger"><?= $data['errors']['status']; ?></small>
                    <?php endif; ?>
                </div>
                <?php if (isset($data['errors']['exception'])): ?>
                    <small class="form-text text-muted alert-danger"><?= $data['errors']['exception']; ?></small>
                <?php endif; ?>

                <br>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>

<script>
    const vueApp = new Vue({
        el: '#vapp',
        data: {
            text: '<?= htmlentities($data['task']->text) ?>',
        },
        mounted() {
        },
        methods: {
        }
    })
</script>
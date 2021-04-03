<div class="container" id="vapp">
    <div class="row">
        <div class="col-md-6">
            <h1>Add Task</h1>

            <form action="#" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="name" v-model="name" >
                    <?php if (isset($data['errors']['name'])): ?>
                        <small id="nameHelp" class="form-text text-muted alert-danger"><?= $data['errors']['name']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="email" v-model="email" >
                    <?php if (isset($data['errors']['email'])): ?>
                        <small id="emailHelp" class="form-text text-muted alert-danger"><?= $data['errors']['email']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="text">Text</label>
                    <textarea v-model="text" id="text" cols="30" rows="5" name="text" class="form-control" ></textarea>
                    <?php if (isset($data['errors']['text'])): ?>
                        <small id="textHelp" class="form-text text-muted alert-danger"><?= $data['errors']['text']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="image">image</label>
                    <input type="file" id="image" @change="onFileChange" name="image" class="form-control" accept="image/jpeg,image/png,image/gif" >
                    <?php if (isset($data['errors']['image'])): ?>
                        <small id="imageHelp" class="form-text text-muted alert-danger"><?= $data['errors']['image']; ?></small>
                    <?php endif; ?>
                </div>
                <?php if (isset($data['errors']['exception'])): ?>
                    <small class="form-text text-muted alert-danger"><?= $data['errors']['exception']; ?></small>
                <?php endif; ?>

                <br>
                <button class="btn btn-outline-secondary" @click.prevent="preview()" >preview image</button>
                <button type="submit" class="btn btn-primary">add task</button>
            </form>
        </div>
        <div class="col-md-6" v-if="is_preview" >
            <h4>Предварительный просмотр</h4>
            <p>Имя: {{ name }}</p>
            <p>Email: {{ email }}</p>
            <p>Текст: {{ text }}</p>

            <div id="preview">
                <img v-if="url" :src="url" style="max-width: 320px; max-height: 240px" />
            </div>
        </div>
    </div>
</div>

<script>
    const vueApp = new Vue({
        el: '#vapp',
        data: {
            name: '',
            email: '',
            text: '',
            is_preview: false,
            url: null,
        },
        mounted() {
        },
        methods: {
            preview() {
                if (this.is_preview)
                    this.is_preview = false;
                else
                    this.is_preview = true;

            },
            onFileChange(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
            }
        }
    })
</script>
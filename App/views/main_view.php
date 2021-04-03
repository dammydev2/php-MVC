<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h1>All task</h1>
            <p>
                <?php if ( ! empty($data['tasks']) ): ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><a href="?order=name&sort=<?= $data['filter']['sort'] == 'asc' ? 'desc' : 'asc'; ?>">name</a></th>
                            <th scope="col"><a href="?order=email&sort=<?= $data['filter']['sort'] == 'asc' ? 'desc' : 'asc'; ?>">Email</a></th>
                            <th scope="col"><a href="?order=status&sort=<?= $data['filter']['sort'] == 'asc' ? 'desc' : 'asc'; ?>">status</a></th>
                            <th scope="col">text</th>
                            <th scope="col">image</th>
                            <th scope="col">edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['tasks'] as $task): ?>
                            <tr>
                                <th scope="row"><?= $task->id; ?></th>
                                <td><?= htmlentities($task->name); ?></td>
                                <td><?= htmlentities($task->email); ?></td>
                                <td><?= ($task->status == 0) ? 'Новое' : 'Выполнено'; ?></td>
                                <td><?= htmlentities($task->text); ?></td>
                                <td><img src="<?= htmlentities($task->image) ?>" style="max-width: 320px; max-height: 240px" ></td>
                                <td><?php if (isset($_COOKIE['auth'])): ?><a href="/task/edit?id=<?= $task->id; ?>">Редактировать</a><?php endif; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
            <nav aria-label="...">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $data['filter']['total_page']; $i++): ?>
                        <li class="page-item <?= ($i == $data['filter']['page']) ? 'active' : ''; ?>">
                            <a class="page-link" href="?order=<?=$data['filter']['order'];?>&sort=<?=$data['filter']['sort'];?>&page=<?=$i;?>"><?=$i?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>

            <?php endif; ?>
            </p>
        </div>
    </div>
</div>
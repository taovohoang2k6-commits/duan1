<h2>Xin chào, <?= $_SESSION['guide']['full_name'] ?></h2>

<h3>Danh sách tour bạn đang phụ trách:</h3>

<table class="table">
    <thead>
        <tr>
            <th>Tour</th>
            <th>Ngày khởi hành</th>
            <th>Vai trò</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tours as $t): ?>
            <tr>
                <td><?= $t['tour_name'] ?></td>
                <td><?= $t['start_date'] ?></td>
                <td><?= $t['role'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
          
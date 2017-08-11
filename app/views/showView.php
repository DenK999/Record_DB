<table>
    <tr>
        <td>Name</td>
        <td>Surname</td>
        <td>Age</td>
    </tr>    
    <?php foreach ($data as $row): ?>    
    <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['surname'] ?></td>
        <td><?= $row['age'] ?></td>
    </tr>
    <?php endforeach; ?>    
</table>

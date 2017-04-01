<?php if(!empty($members)):  ?>
<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Member Name</th>
            <th>Initial Deposit</th>
            <th>Contact Number</th>
            <th>Goal Progress</th>
            <th>Borrowed Balance</th>
            <th>Contributed Money</th>
            <th>Date Joined</th>
        </tr>
    </thead>
    <tbody>
        <?php $num = 1; ?>
        <?php foreach($members as $member): ?>
            <?php 
                $date = new DateTime($member['m_date_registered']);
                $formattedDate = $date->format('F d, Y');
                echo '<tr>';
                echo '<td>' . $num . '</td>';
                echo '<td>' . $member['m_name'] . '</td>';
                echo '<td>' . $member['m_initial_deposit'] . '</td>';
                echo '<td>' . $member['m_contact'] . '</td>';
                echo '<td>' . $member['m_goal_progress'] . '</td>';
                echo '<td>' . $member['m_borrowed'] . '</td>';
                echo '<td>' . $member['m_contributed'] . '</td>';
                echo '<td>' . $formattedDate . '</td>';
                echo '</tr>';

                $num++;
            ?>
        <?php endforeach; ?>
    </tbody>
</table>
    <?php else:  ?>
    <p> Searched not found :( </p>
    <?php endif; ?>
    <?php echo $this->ajax_pagination->create_links(); ?>
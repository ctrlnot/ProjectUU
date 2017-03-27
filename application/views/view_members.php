
    <h3>Insert Members</h3>
    <form id="memberForm" action="members/validate" method="post">
        <input type="text" name="name" class="name" placeholder="Name"><br><br>
        <input type="number" name="initial" class="currency" min="0" value="100.00"><br><br>
        <input type="text" name="contact" class="contact" placeholder="Contact Number"><br><br>
        <input type="date" name="date_registered" class="date_registered"><br><br>
        <input type="submit" value="Register Member">
        <p class="response"></p>
    </form>
    
    <h3>Members:</h3>
    
    <table class="table table-striped">
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
            <?php 
            $num = 1;

            foreach($membersInfo as $row) {
                $date = new DateTime($row->m_date_registered);
                $formattedDate = $date->format('F d, Y');

                echo '<tr>';
                echo '<td>' . $num . '</td>';
                echo '<td>' . $row->m_name . '</td>';
                echo '<td>' . $row->m_initial_deposit . '</td>';
                echo '<td>' . $row->m_contact . '</td>';
                echo '<td>' . $row->m_goal_progress . '</td>';
                echo '<td>' . $row->m_borrowed . '</td>';
                echo '<td>' . $row->m_contributed . '</td>';
                echo '<td>' . $formattedDate . '</td>';
                echo '</tr>';

                $num++;
            }
            ?>
        </tbody>
    </table>

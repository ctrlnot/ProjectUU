
    <h3>Insert Members</h3>
    <form id="memberForm" action="members/validate" method="post">
        <input type="text" name="name" class="name" placeholder="Name"><br><br>
        <input type="number" name="initial" class="currency" min="0" value="100.00"><br><br>
        <input type="text" name="contact" class="contact" placeholder="Contact Number"><br><br>
        <input type="submit" value="Register Member">
        <p class="response"></p>
    </form>
    
    <h3>Members:</h3>
    <div class="row">
        <div class="col-md-6 form-group">
            <input type="text" id="keywords" class="form-control search" placeholder="Search member" onkeyup="searchFilter()">
        </div>
        <div class="col-md-6 form-group">
            <select id="sortBy" class="form-control" onchange="searchFilter()">
                <option disabled>Sort By</option>
                <option value="a-z" selected>A-Z</option>
                <option value="z-a">Z-A</option>
                <option value="lat">Latest - Oldest</option>
                <option value="old">Oldest - Latest</option>
            </select>
        </div>
    </div>
    <div id="members-table">
        <?php if(!empty($members)):  ?>
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
        <?php else: ?>
        <p> Searched not found :( </p>
        <?php endif; ?>
        <?php echo $this->ajax_pagination->create_links(); ?>
    </div>

    <div class="loading" style="display: none;">
        <img src="assets/img/loading.gif" alt="Loading...">
    </div>
    
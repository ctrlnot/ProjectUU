
    <div class="row wrapper">
        <div class="col-md-12 left-info">
            <div class="members-info">
                <h3><span class="glyphicon glyphicon-user"></span> &nbsp;MEMBERS INFO</h3>
                <div class="row">
                    <div class="col-md-3">
                        <button class="add-member" data-toggle="modal" data-target="#myModal">
                            Add Member
                        </button>
                    </div>
                    <div class="col-md-3">
                        <input type="text" id="keywords" class="search" placeholder="Search member" onkeyup="searchFilter()">
                    </div>
                    <div class="col-md-2">
                        <select id="sortBy" class="sortBy" onchange="searchFilter()">
                            <option disabled>Sort By</option>
                            <option value="a-z" selected>A-Z</option>
                            <option value="z-a">Z-A</option>
                            <option value="lat">Latest - Oldest</option>
                            <option value="old">Oldest - Latest</option>
                        </select>
                    </div>
                </div>
                <div id="members-table" class="table-responsive">
                    <?php if(!empty($members)):  ?>
                    <table class="table text-nowrap table-borderless">
                        <thead>
                            <tr>
                                <th>Member Name</th>
                                <th>Initial Deposit</th>
                                <th style="width:20%">Goal Progress</th>
                                <th>Borrowed Balance</th>
                                <th>Contributed Money</th>
                                <th>Contact Number</th>
                                <th>Date Joined</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($members as $member): ?>
                                <?php 
                                    $date = new DateTime($member['m_date_registered']);
                                    $formattedDate = $date->format('F d, Y');
                                    $status = '';

                                    if(!$member['m_status']) {
                                        $status = 'member-status-inactive';
                                    } else {
                                        $member['m_borrowed'] > 1 ? $status = 'member-status-indebt' : $status = 'member-status-clear'; 
                                    }

                                    echo
                                    '<tr>' .
                                        '<td class="' . $status . '"><div>' . $member['m_name'] . '</div></td>' .
                                        '<td><div>&#8369; ' . number_format($member['m_initial_deposit'], 2, '.', ',') . '</div></td>' .
                                        '<td><div>' .
                                            '<div class="progress">
                                                <div class="progress-bar progress-bar-bg" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:75%">
                                                75% Complete (info)
                                                </div>
                                            </div>' .
                                        '</div></td>' .
                                        '<td><div>&#8369; ' . number_format($member['m_borrowed'], 2, '.', ',') . '</div></td>' .
                                        '<td><div>&#8369; ' . number_format($member['m_contributed'], 2, '.', ',') . '</div></td>' .
                                        '<td><div>' . $member['m_contact'] . '</div></td>' . 
                                        '<td><div>' . $formattedDate . '</div></td>' .
                                        '<td><div> <span class="glyphicon glyphicon-remove-circle"></span> </div></td>' .
                                    '</tr>';
                                ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p> Searched not found :( </p>
                    <?php endif; ?>
                    <?php echo $this->ajax_pagination->create_links(); ?>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3><span class="glyphicon glyphicon-plus-sign"></span> &nbsp; ADD MEMBER</h3>
                  </div>
                  <div class="modal-body">
                    <form id="memberForm" action="members/validate" method="post">
                        <input type="text" name="name" class="name" placeholder="Name">
                        <input type="number" name="initial" class="currency" min="0" value="100.00">
                        <input type="text" name="contact" class="contact" placeholder="Contact Number">
                        <input type="submit" class="submit-member" value="ADD MEMBER">
                    </form>
                  </div>
                </div>

            </div>
        </div>
        <!-- <div class="col-md-3 right-info">
                <h3><span class="glyphicon glyphicon-plus-sign"></span> &nbsp; ADD MEMBER</h3>
                <form id="memberForm" action="members/validate" method="post">
                    <input type="text" name="name" class="name" placeholder="Name">
                    <input type="number" name="initial" class="currency" min="0" value="100.00">
                    <input type="text" name="contact" class="contact" placeholder="Contact Number">
                    <input type="submit" class="submit-member" value="ADD MEMBER">
                </form>
        </div> -->
    </div>
    
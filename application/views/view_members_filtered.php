                    <?php if(!empty($members)):  ?>
                    <table class="table text-nowrap table-borderless">
                        <thead>
                            <tr>
                                <!-- <th>#</th> -->
                                <th style="width:12%">Member Name</th>
                                <th style="width:10%">Initial Deposit</th>
                                <th style="width:20%">Goal Progress</th>
                                <th style="width:15%">Borrowed Balance</th>
                                <th style="width:15%">Contributed Money</th>
                                <th style="width:15%">Contact Number</th>
                                <th style="width:15%">Date Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $num = 1; ?>
                            <?php foreach($members as $member): ?>
                                <?php 
                                    $date = new DateTime($member['m_date_registered']);
                                    $formattedDate = $date->format('F d, Y');
                                    echo
                                    '<tr>' .
                                        '<td class="member-status-indebt"><div>' . $member['m_name'] . '</div></td>' .
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
                                    '</tr>';

                                    $num++;
                                ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p> Searched not found :( </p>
                    <?php endif; ?>
                    <?php echo $this->ajax_pagination->create_links(); ?>
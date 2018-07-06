<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">

      <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="index.php"?"active":"";?>">
        <a href="../dashboard">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
     
  

      <li class='header text-left '>MAINTENANCE</li>
      <li class="treeview <?php echo $financial; ?>">
				<a href="../inquiry/inquiry.php">
				<i class="fa fa-search"></i> 
				<span>Inquiry</span>
				</a>
      </li>
      <?php
      if(AllowUser(array(1,3))){
      ?>
      <li class="treeview <?php echo $financial; ?>">
				<a href="#">
				<i class="glyphicon glyphicon-stats"></i> 
				<span>Marketing</span>
				</a>
				<ul class="treeview-menu menu-open">
					<li class="<?php if($page1=='loan_management'){echo 'Active';} ?>"><a href="../marketing/loan_management.php">
						<i class="fa fa-circle"></i>
						<span>Loan Management</span>
						</a>
					</li>
          <li class="<?php if($page1=='Loan_management'){echo 'Active';} ?>"><a href="../marketing/credit_approval.php">
						<i class="fa fa-circle"></i>
						<span>Credit Committee</span>
						</a>
          </li>
          <li class="<?php if($page1=='checklist'){echo 'Active';} ?>"><a href="../marketing/credit_advising.php">
            <i class="fa fa-circle"></i>
            <span>Credit Advising</span>
            </a>
          </li>
          <li class="<?php if($page1=='checklist'){echo 'Active';} ?>"><a href="../marketing/collateral_form.php">
            <i class="fa fa-circle"></i>
            <span>Collateral Entry/Update</span>
            </a>
          </li>
          <li class="<?php if($page1=='checklist'){echo 'Active';} ?>"><a href="../marketing/checklist_entry_update.php">
            <i class="fa fa-circle"></i>
            <span>Checklist Entry/Update</span>
            </a>
          </li>
          <li class="<?php if($page1=='instruction_sheet_prep'){echo 'Active';} ?>"><a href="../marketing/instruction_sheet_prep.php">
						<i class="fa fa-circle"></i>
						<span>Instruction Sheet Prep.</span>
						</a>
          </li>
				</ul>
			
      </li>
     
      <?php
      }if(AllowUser(array(1,3))){
      ?>
      <li class="treeview <?php echo $financial; ?>">
				<a href="#">
				<i class="fa fa-list-alt"></i> 
				<span>Credit</span>
				</a>
				<ul class="treeview-menu menu-open">
					<li class="<?php if($page1=='Ci_checking'){echo 'Active';} ?>"><a href="../credit/ci_checking.php">
						<i class="fa fa-circle"></i>
						<span>CI Checking</span>
						</a>
					</li>
          <li class="<?php if($page1=='Ci_checking'){echo 'Active';} ?>"><a href="../credit/reco_app.php">
						<i class="fa fa-circle"></i>
						<span>Recommendation of </span><br><span style="padding-left:25px;">Application</span>
						</a>
					</li>
				</ul>
      </li>
      <li class='header text-left '>ACCOUNTING</li>
      <?php
      }
      if(AllowUser(array(1))){
      ?>
        <li class="treeview <?php echo $ledger; ?>">
          <a href="#">
            <i class="glyphicon glyphicon-book"></i> 
            <span>Loan Receivables</span>
          </a>
          <ul class="treeview-menu menu-open">
              <li class="<?php if($page1=='loan_approval'){echo 'Active';} ?>"><a href="../accounting/loan_approval.php">
                <i class="fa fa-file-text"></i>
                <span>Loan Approval</span>
                </a>
              </li>
              <li class="<?php if($page1=='preparation'){echo 'Active';} ?>"><a href="../accounting/preparation.php">
                <i class="fa fa-file-text"></i>
                <span>Loan Distribution/Preparation</span>
                </a>
              </li>
              <li class="<?php if($page1=='booking_of_new_loan.php'){echo 'Active';} ?>"><a href="../accounting/booking_of_new_loan.php">
                <i class="fa fa-file-text"></i>
                <span>Booking of New Loans</span>
                </a>
              </li>
              <li class="<?php if($page1=='change_due_date'){echo 'Active';} ?>"><a href="../accounting/change_due_date.php">
                <i class="fa fa-file-text"></i>
                <span>Change of Due Date</span>
                </a>
              </li>
              <li class="<?php if($page1=='change_due_date'){echo 'Active';} ?>"><a href="#">
                <i class="fa fa-file-text"></i>
                <span>Processing of Payments</span>
                </a>
              </li>
              <li class="<?php if($page1=='change_due_date'){echo 'Active';} ?>"><a href="#">
                <i class="fa fa-file-text"></i>
                <span>Update of AP/UDI</span>
                </a>
              </li>
              
          </ul>
        </li>
        <li class="treeview <?php echo $ledger; ?>">
          <a href="#">
            <i class="glyphicon glyphicon-book"></i> 
            <span>General Accounting</span>
          </a>



          <ul class="treeview-menu menu-open">
          
         
             <!--    <span>General Ledger Entries</span> -->
                      <li class="treeview <?php echo $ledger; ?>">
                        <a href="#">
                          <i class="fa fa-file-text"></i> 
                          <span> General Ledger Entries </span>
                        </a>
                        <ul class="treeview-menu menu-open">
                            <li class="<?php if($page1=='General_ledger'){echo 'Active';} ?>"><a href="../accounting/cv_gl_entries.php">
                              <i class="fa fa-file-text"></i>
                              <span>Cheque Voucher</span>
                              </a>
                            </li>
                            <li class="<?php if($page1=='General_ledger'){echo 'Active';} ?>"><a href="../accounting/jv_gl_entries.php">
                              <i class="fa fa-file-text"></i>
                              <span>Journal Voucher</span>
                              </a>
                            </li>
                            <li class="<?php if($page1=='General_ledger'){echo 'Active';} ?>"><a href="../accounting/report_gl.php">
                              <i class="fa fa-file-text"></i>
                              <span>Report</span>
                              </a>
                            </li>
                           
                           
 
                        </ul>
                      </li>



                </a>
              </li>
              <li class="<?php if($page1=='General_ledger'){echo 'Active';} ?>"><a href="#">
                <i class="fa fa-file-text"></i>
                <span>Ledger Codification</span>
                </a>
              </li>
              <li class="<?php if($page1=='General_ledger'){echo 'Active';} ?>"><a href="#">
                <i class="fa fa-file-text"></i>
                <span>Depreciation of Fixed Assets</span>
                </a>
              </li>
              
              
              
          </ul>
        </li>
        <li class="treeview <?php echo $ledger; ?>">
          <a href="#">
            <i class="glyphicon glyphicon-book"></i> 
            <span>Cashiering</span>
          </a>
          <ul class="treeview-menu menu-open">
              <li class="<?php if($page1=='ass_or'){echo 'Active';} ?>"><a href="../accounting/ass_or.php">
                <i class="fa fa-file-text"></i>
                <span>Assigning of O.R</span>
                </a>
              </li>
              <li class="<?php if($page1=='Trial_balance'){echo 'Active';} ?>"><a href="#">
                <i class="fa fa-file-text"></i>
                <span>Deposit in Banks</span>
                </a>
              </li>
          </ul>
        </li>
        <li class='header text-left '>ADMINISTRATOR</li>
        
      <?php
      };
      ?>

      

    <?php if(AllowUser(array(1))){ ?>
    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="audit_logs.php"?"active":"";?>"><a href="../administrator/audit_logs.php"><i class="fa fa-edit"></i><span>Audit Logs</span> </a></li>
    <?php }
       ?>
        <li class="treeview">
					<a href="#"><i class="fa fa-folder"></i> <span>Metadata</span></a>
              <ul class="treeview-menu menu-open">
                <li class="<?php if($page1=='Loan_type'){echo 'Active';} ?>"><a href="../administrator/loan_type.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Loan Type</span>
                  </a>
                </li>
                <li class="<?php if($page1=='requirement'){echo 'Active';} ?>"><a href="../administrator/requirement.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Requirement</span>
                  </a>
                </li>
                <li class="<?php if($page1=='manner_of_payment'){echo 'Active';} ?>"><a href="../administrator/manner_of_payment.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Manner of Payment</span>
                  </a>
                </li>
                <li class="<?php if($page1=='payment_type'){echo 'Active';} ?>"><a href="../administrator/payment_type.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Payment Type</span>
                  </a>
                </li>
                <li class="<?php if($page1=='bank'){echo 'Active';} ?>"><a href="../administrator/bank.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Bank</span>
                  </a>
                </li>
                <li class="<?php if($page1=='bank'){echo 'Active';} ?>"><a href="../administrator/dealer.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Dealer</span>
                  </a>
                </li>
                <li class="<?php if($page1=='bank'){echo 'Active';} ?>"><a href="../administrator/salesman.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Salesman</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Credit_facility'){echo 'Active';} ?>"><a href="../administrator/credit_facility.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Credit Facility</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Product_line'){echo 'Active';} ?>"><a href="../administrator/product_line.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Product Line</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Marketing_type'){echo 'Active';} ?>"><a href="../administrator/marketing_type.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Marketing Type</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Collateral_code'){echo 'Active';} ?>"><a href="../administrator/collateral_code.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Collateral Code</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Collateral_code'){echo 'Active';} ?>"><a href="../administrator/industry_corp.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Individual / Corporation</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Collateral_code'){echo 'Active';} ?>"><a href="../administrator/business_type.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Business Type</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Collateral_code'){echo 'Active';} ?>"><a href="../administrator/industry_code.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Industry Code</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Collateral_code'){echo 'Active';} ?>"><a href="../administrator/client_type.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Client Type</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Collateral_code'){echo 'Active';} ?>"><a href="../administrator/country.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Country</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Collateral_code'){echo 'Active';} ?>"><a href="../administrator/region.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Region</span>
                  </a>
                </li>
                <li class="<?php if($page1=='Collateral_code'){echo 'Active';} ?>"><a href="../administrator/civil_status.php">
                  <i class="fa fa-circle-o"></i>
                  <span>Civil Status</span>
                  </a>
                </li>
              </ul>
        </li>
        <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="approval_flow.php"?"active":"";?>"><a href="../administrator/approval_flow.php"><i class="fa fa-user"></i> <span>Approval Flow</span></a></li>
        <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_users.php"?"active":"";?>"><a href="../administrator/view_users.php"><i class="fa fa-user"></i> <span>Users</span></a></li>
        <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="account_settings.php"?"active":"";?>"><a href="../administrator/account_settings.php"><i class="fa fa-gear"></i> <span>Change Password</span></a></li>

  </ul>
</section>
<!-- /.sidebar -->
</aside>
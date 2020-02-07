    <!-- main menu-->
    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
      <!-- main menu header-->
      <!--div class="main-menu-header">
        <input type="text" placeholder="Search" class="menu-search form-control round"/>
      </div-->
      <!-- / main menu header-->
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>home/dashboard">
              <i class="icon-dashboard"></i><span data-i18n="nav.dash.main" class="menu-title">Dashboard</span>
            </a>
            
          </li> 
          <?php if($this->session->userdata('AdminId')==1){ ?>
            
         <li class="nav-item">
            <a>
              <i class="icon-user"></i><span data-i18n="nav.dash.main" class="menu-title">Admin</span>
            </a>
            <ul class="menu-content">
              <li>
                <a href="<?php echo base_url(); ?>home/addadmin" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add Admin</a>
              </li>
              <li>
              <li>
                <a href="<?php echo base_url(); ?>home/adminlist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i>List of Admin</a>
              </li>
            </ul>
          </li> 
          <?php } ?>
          <li class="nav-item">
            <a>
              <i class="icon-users"></i><span data-i18n="nav.dash.main" class="menu-title">Student</span>
            </a>
            <ul class="menu-content">
            <!--   <li>
                <a href="<?php //echo base_url(); ?>User/Useradd" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add User </a>
              </li> -->
              <li>
                <a href="<?php echo base_url(); ?>student/studentlist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of Student </a>
              </li>
            </ul>
          </li>
              <li class="nav-item">
                  <a href="<?php echo base_url();?>home/inquerylist">
                         <i class="icon-users"></i><span data-i18n="nav.dash.main" class="menu-title">Inquery List</span>
                  </a>
              </li>
              <li class="nav-item">
                <a>
                  <i class="icon-comments"></i><span data-i18n="nav.dash.main" class="menu-title">Testimonial</span>
                </a>
                <ul class="menu-content">
                  <li>
                    <a href="<?php echo base_url(); ?>testimonial/addtestimonial" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add Testimonial</a>
                  </li>
                 
                  <li>
                    <a href="<?php echo base_url(); ?>testimonial/testimoniallist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i>List of Testimonial</a>
                  </li>
                </ul>
              </li> 
              <li class="nav-item">
                <a>
                  <i class="icon-blog"></i><span data-i18n="nav.dash.main" class="menu-title">Blog</span>
                </a>
                <ul class="menu-content">
                  <li>
                    <a href="<?php echo base_url(); ?>blog/addblog" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i>Add Blog</a>
                  </li>
                 
                  <li>
                    <a href="<?php echo base_url(); ?>blog/bloglist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i>List of Blog</a>
                  </li>
                </ul>
              </li> 
                 <li class="nav-item">
                <a>
                  <i class="icon-blog"></i><span data-i18n="nav.dash.main" class="menu-title">Our Services</span>
                </a>
                <ul class="menu-content">
                  <!-- <li>
                    <a href="<?php echo base_url(); ?>services/addservices" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i>Add Services</a>
                  </li> -->
                 
                  <li>
                    <a href="<?php echo base_url(); ?>services/serviceslist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i>List of services</a>
                  </li>
                </ul>
              </li> 
               <li class="nav-item">
                <a>
                  <i class="icon-rupee"></i><span data-i18n="nav.dash.main" class="menu-title">Price & Plan</span>
                </a>
                <ul class="menu-content">
                  <li>
                    <a href="<?php echo base_url(); ?>price/addprice" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add Price</a>
                  </li>
                  <li>
                    <a href="<?php echo base_url(); ?>price/pricelist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of Price </a>
                  </li>
                    <li class="nav-item">
                      <a><i class="icon-pie-chart"></i><span data-i18n="nav.dash.main" class="menu-title">Plan</span>
                      </a>
                      <ul class="menu-content">
                          <li>
                          <a href="<?php echo base_url(); ?>price/addplan" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add Plan</a>
                          </li>
                          <li>
                          <a href="<?php echo base_url(); ?>price/planlist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of Plan </a>
                          </li>
                      </ul>
                    </li>
                </ul>              
          </li>

            <li class="nav-item">
                      <a><i class="icon-library"></i><span data-i18n="nav.dash.main" class="menu-title">Career Library</span>
                      </a>
                      <ul class="menu-content">
                          <li>
                          <a href="<?php echo base_url(); ?>Library/addlibrary" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add Career Library</a>
                          </li>
                          <li>
                          <a href="<?php echo base_url(); ?>Library" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of Career Library </a>
                          </li>
                      </ul>

                    </li>
                      

                    <li class="nav-item">
                      <a><i class="icon-list"></i><span data-i18n="nav.dash.main" class="menu-title">Success story</span>
                      </a>
                      <ul class="menu-content">
                          <li>
                          <a href="<?php echo base_url(); ?>Stories/addstory" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add Success story </a>
                          </li>
                          <li>
                          <a href="<?php echo base_url(); ?>Stories" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of Success story </a>
                          </li>
                      </ul>
                    </li>

                    <li class="nav-item">
                      <a><i class="icon-list"></i><span data-i18n="nav.dash.main" class="menu-title">Program Page extra content</span>
                      </a>
                      <ul class="menu-content">
                          <li>
                           <a href="<?php echo base_url(); ?>Help/keylist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of Key Highlights </a>
                          </li>
                          <li>
                          <a href="<?php echo base_url(); ?>Help/helplist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of help </a>
                          <li>
                           <a href="<?php echo base_url(); ?>Help/learnlist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> What will you learn section </a>
                          </li>
                           <li>
                           <a href="<?php echo base_url(); ?>Programs/faqlist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of faq </a>
                          </li>
                          </li>
                      </ul>
                    </li>

                       <li class="nav-item">
                      <a><i class="icon-list"></i><span data-i18n="nav.dash.main" class="menu-title">Programs</span>
                      </a>
                      <ul class="menu-content">
                          <li>
                        <!--   <a href="<?php echo base_url(); ?>Programs/addprogramme" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add Programs  </a> -->
                          </li>
                          <li>
                          <a href="<?php echo base_url(); ?>Programs" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of Programs </a>
                          </li>

                          <li>
                         <!--  <a href="<?php echo base_url(); ?>Programs/addcat" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add  Program Category </a> -->
                          </li>
                          <li>
                          <a href="<?php echo base_url(); ?>Programs/category" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of Program category </a>
                          </li>
                            <li>
                          <!-- <a href="<?php echo base_url(); ?>Programs/addsubcat" data-i18n="nav.dash.main" class="menu-item"><i class="icon-plus"></i> Add  Program Subcategory </a> -->
                          </li>
                          <li>
                          <a href="<?php echo base_url(); ?>Programs/subcategory" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> List of Program Subcategory </a>
                          </li>
                      </ul>
                    </li>

             </li>

              <li class="nav-item">
                      <a><i class="icon-list"></i><span data-i18n="nav.dash.main" class="menu-title">About</span>
                      </a>
                      <ul class="menu-content">
                          
                          <li>
                          <a href="<?php echo base_url(); ?>About/" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> About </a>
                          </li>
                           <li>
                          <a href="<?php echo base_url(); ?>About/contact_list" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> Contact list </a>
                          </li>
                           <li>
                          <a href="<?php echo base_url(); ?>About/partnercatlist" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> Partners category </a>
                          </li>
                          <li>
                          <a href="<?php echo base_url(); ?>About/partners" data-i18n="nav.dash.main" class="menu-item"><i class="icon-file-text2"></i> Partners  </a>
                          </li>
                      </ul>
                    </li>

             <li class="nav-item">
                  <a href="<?php echo base_url(); ?>home/setting"><i class="icon-cog"></i><span data-i18n="nav.dash.main" class="menu-title">Settings</span>
                  </a>
                     
             </li>

        </ul>
      </div>
      <!-- /main menu content-->
      <!-- main menu footer-->
      <!-- include includes/menu-footer-->
      <!-- main menu footer-->
    </div>
    <!-- / main menu-->
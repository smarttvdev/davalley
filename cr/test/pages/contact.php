<?php
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
require_once("../SMS_Module/classes/config.php");
require_once("..//SMS_Module/classes/mysqli.php");
require_once("..//SMS_Module/classes/sql.class.php");


?>

      <h2>Contact Us</h2>
      <div class="address-container contact-icon">
        <p><img alt="Image-alt" src="images/icons/phone.png" /> <a href="tel:<?php echo $CONFIG['contact_phone']; ?>"><?php echo $CONFIG['contact_phone']; ?></a></p>
        <p><img alt="Image-alt" src="images/icons/fax.png" /> <a href="tel:<?php echo $CONFIG['contact_phone']; ?>"><?php echo $CONFIG['contact_phone']; ?></a></p>
        <p><img alt="Image-alt" src="images/icons/email.png" /> <a href="mailto:<?php echo $CONFIG['contact_email']; ?>"><?php echo $CONFIG['contact_email']; ?></a></p>
        <p><img alt="Image-alt" src="images/icons/location.png" /> <a href="mailto:<?php echo $CONFIG['contact_email']; ?>"><?php echo $CONFIG['contact_address']; ?></a></p>
      </div>
      <div class="address-container map-container">
        <iframe scrolling="no" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;q=2040+W+Deer+Valley+Rd%2C+Phoenix%2C+Arizona+85027%2C+United+States&amp;aq=&amp;sll=33.684211,-112.103977&amp;sspn=0.010874,0.021136&amp;vpsrc=0&amp;ie=UTF8&amp;geocode=FQvyEQMdJgz-_w&amp;split=0&amp;hq=&amp;hnear=2040+W+Deer+Valley+Rd%2C+Phoenix%2C+Arizona+85027%2C+United+States&amp;t=m&amp;z=14&amp;ll=33.684211,-112.103977&amp;output=embed"></iframe>      
      </div>
      <div class="address-container">
        
        <div class="approved success-message hidden">
              <div class="typo-icon">
                Your message has been received by us, we will get back to you at the earliest.
              </div>
        </div>
        <form action="submit_contact.php" method="post" />
          <div class="form-element">
            <label for="txtfullname">Full Name</label>
            <input id="txtfullname" name="fullname" type="text" placeholder="required" required="" />
          </div>
          <div class="form-element">
            <label for="txtemail">Email</label>
            <input id="txtemail" name="email" type="email" placeholder="required" required="" />
          </div>
          <div class="form-element">
            <label for="txtcontact">Contact Number</label>
            <input id="txtcontact" name="contact" type="tel" placeholder="optional" />
          </div>
          <div class="form-element">
            <label for="txtmessage">Message</label>
            <textarea id="txtmessage" name="message" placeholder="required" rows="5" required=""></textarea>
          </div>
          <input type="reset" class="button button3" value="Reset" />
          <input type="submit" class="button button2" value="Send Message" />
        </form>
      </div>
      
      
      

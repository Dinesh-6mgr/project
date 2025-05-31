<?php
include "includes/header.php";
?>

  <div class="flex-container">
    <!-- Contact Info -->
    <div class="info-section" >
      <h2 style="text-align: centers;">Find us</h2>
      
      <div style="display: flex; align-items: center; gap: 20px; justify-content: center; margin-top: 20px;">

  <div style="text-align: center;">
    <p style="margin: 0;"><strong>Facebook</strong></p>
    <a href="https://www.facebook.com" target="_blank" style="color: #4267B2;">
      <i class="fab fa-facebook fa-2x"></i>
    </a>
  </div>
  <div style="text-align: center;">
    <p style="margin: 0;"><strong>Mail</strong></p>
    <a href="mailto:test@example.com" style="color: #D44638;">
      <i class="fas fa-envelope fa-2x"></i>
    </a>
  </div>

</div>

      <br>
      <br>
      <section>
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14133.973970564772!2d84.1808081!3d27.6711385!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399456ce7d000001%3A0x8450e6b7d036933e!2sJanajyoti%20Namuna%20Secondary%20School!5e0!3m2!1sen!2snp!4v1745726263989!5m2!1sen!2snp"
      width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
  </section>
    </div>
    <!-- Contact Form -->
    <div class="form-section">
      <form action="save_contact.php" method="POST">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Send</button>
    
</div>

    </div>
    
  </div>
  
  <?php

include "includes/footer.php";
?>
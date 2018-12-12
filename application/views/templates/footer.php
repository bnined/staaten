  <!-- Footer -->

  <footer id="footer">

      <!-- Footernavigation -->

      <h1>Footernavigation</h1> <!-- ausgeblendet für den Screenreader -->

      <nav id="footernav">
        <ul class="flexbox">
          <?php
          if($this->session->lang == "de") {
            echo "<li><a href='".site_url('sitemap/index')."'>Sitemap</a></li>
            <li><a href='".site_url('kontakt/index')."'>Kontakt</a></li>
            <li><a href='".site_url('impressum/index')."'>Impressum</a></li>
            <li><a href='".site_url('datenschutz/index')."'>Datenschutz</a></li>";
          } elseif($this->session->lang == "en") {
            echo "<li><a href='".site_url('sitemap/index')."'>Sitemap</a></li>
            <li><a href='".site_url('kontakt/index')."'>Contact</a></li>
            <li><a href='".site_url('impressum/index')."'>Imprint</a></li>
            <li><a href='".site_url('datenschutz/index')."'>Privacy</a></li>";
          }
          ?>
        </ul>
      <!--  <p>Sitemap || Kontakt || Impressum || Datenschutz</p> -->
      </nav>

  </footer>
  </div>
  </div>  <!-- Ende openNav -->

  </body>
</html>

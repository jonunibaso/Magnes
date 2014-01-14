<?
class Seo extends CI_Controller {

  function sitemap()
  {
    	/*
        $data = array('Gasket' => 15.29,
               'Wheel'  => 75.25,
               'Tire'   => 50.00);


        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap",$data);
        */
        $sitemap = "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
  
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url() . "</loc>\n\t\t<priority>1.0</priority>\n\t\t<changefreq>hourly</changefreq>\n\t</url>\n\n";

        for ($i = 2; $i <= 10; $i++) {
         $sitemap .= "\t<url>\n\t\t<loc>" . site_url('front/page/'.$i) . "</loc>\n\t\t<priority>".(1-(($i-1)/20))."</priority>\n\t\t<changefreq>daily</changefreq>\n\t</url>\n\n";
        }

    
        $this->load->database();
        $this->db->select('*');
        $this->db->from('release');
        $this->db->order_by("release.id", "desc");
        $query = $this->db->get();
        $releases = $query->result();

        foreach ($releases as $l) {

           $sitemap .= "\t<url>\n\t\t<loc>" . site_url('release/download/'.$l->slug) . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        }
        
        $this->db->select('*');
        $this->db->from('labels');
        $this->db->order_by("labels.id", "desc");
        $query = $this->db->get();
        $releases = $query->result();

        foreach ($releases as $l) {

           $sitemap .= "\t<url>\n\t\t<loc>" . site_url('label/view/'.$l->label_slug ) . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        }

        
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url() . "</loc>\n\t\t<priority>1.0</priority>\n\t</url>\n\n";

        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/a') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/b') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/c') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/d') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/e') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/f') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/g') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/h') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/i') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/j') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/k') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/l') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/m') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/n') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/o') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/p') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/q') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/r') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/s') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/t') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/u') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/v') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/w') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/x') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/y') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";
        $sitemap .= "\t<url>\n\t\t<loc>" . site_url('artist/letter/z') . "</loc>\n\t\t<changefreq>weekly</changefreq>\n\t</url>\n\n";



    // About page

 /*
     // Get all recipes (records) from database. Load (or autoload) the model
    $this->ci->load->model('recipe_model');
    $recipes = $this->ci->recipe_model->find_where();
 
    // Add each recipe URL to the sitemap while enclosing the URL in the XML <url> tags
    // Since my database tracks the last updated date, I am including that as well - but with the date only in YYYY-MM-DD format
    foreach($recipes['results'] as $recipe)
    {
       $sitemap .= "\t<url>\n\t\t<loc>" . site_url('recipe/show/' . $recipe->get_nice_url()) . "</loc>\n";
       $sitemap .= "\t\t<lastmod>" . date('Y-m-y' ,strtotime($recipe->updated_date)) . "</lastmod>\n \t</url>\n\n";
    }
 
    // If you have other records you wish to include, get those and continue to append URL's to the sitemap.
 */
    // Close with the footer
    $sitemap .= "</urlset>\n";

    // Write the sitemap string to file. Make sure you have permissions to write to this file.
    $file = fopen('sitemap.xml', 'w');
    fwrite($file, $sitemap);
    fclose($file);


    $sitemap_url = site_url('sitemap.xml');
    $google_url = "http://www.google.com/webmasters/tools/ping?sitemap=".urlencode($sitemap_url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt ($ch, CURLOPT_URL, $google_url);
    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      // Log error if update fails
    if (substr($http_status, 0, 1) != 2)
    {
      log_message('error', 'Ping Google with updated sitemap failed. Status: ' . $http_status);
      log_message('error', '    ' . $google_url);
    }
    
    
    return;
  }
}
?>
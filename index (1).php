<?php
// Code by Tiến Đức (Fb.Com/AnhDucCEI) - Tôn Trọng Bố Đi Mấy Thằng Lồn
  $cookie = 'datr=Fw9LXblSsB0ZWvbhP28yeuKI; sb=Fw9LXS5m8FzpGCmi7EnvNjk0; ; _fbp=fb.1.1567993338786.1404375854; c_user=100007535415303; xs=13%3ADliUbFcKEgH9dQ%3A2%3A1567994000%3A14128%3A6985; spin=r.1001149601_b.trunk_t.1568028367_s.1_v.2_; fr=0LPSxOgXYPwZU6XuM.AWVwp-cUxQi3NdYAOeV606gpk1Q.BdSvbf._U.F10.0.0.BddrML.AWUM6Ne4; presence=EDvF3EtimeF1568060242EuserFA21B07535415303A2EstateFDsb2F1568028181843EatF1568028201537Et3F_5bDiFA2user_3a1B13295760447A2EoF1EfF4C_5dElm3FnullEutc3F1568060242180G568060242256CEchFDp_5f1B07535415303F1CC; act=1568060335948%2F21; wd=725x667';
  $content = auto('https://mbasic.facebook.com/home.php?sk=h_chr', $cookie);
  preg_match('#target" value="(.+?)"#is', $content, $id_user);
  $id_user = $id_user['1'];
  preg_match('#fb_dtsg" value="(.+?)"#is', $content, $fb_dtsg);
  $fb_dtsg = $fb_dtsg['1'];
  if (preg_match_all('#ft_ent_identifier=(.+?)&#is', $content, $story)) {
    $datapost = file_get_contents('idpost.log');
    for ($i=0; $i<count($story['1']); $i++) {
echo count($story['1']);
      $id_stt = $story['1'][$i];
      $comment = array('❤',);
      $cmt = $comment[rand(0, count($comment)-1)];
      if (strpos($datapost, $id_stt) == 0) {
        $reaction = auto('https://mbasic.facebook.com/reactions/picker/?ft_id=' . $id_stt . '&av=' . $id_user, $cookie);
        preg_match_all('#a href="(.+?)"#is', $reaction, $love);
        auto('https://mbasic.facebook.com' . $love['1'][rand(0, 5)], $cookie, 'fb_dtsg=' . $fb_dtsg . '&reaction_type=' . rand(0, 5));
        auto('https://mbasic.facebook.com/a/comment.php?ft_ent_identifier=' . $id_stt . '&av=' . $id_user, $cookie, 'fb_dtsg=' . $fb_dtsg . '&comment_text=' . urlencode($cmt));
        echo 'Done ' . $id_stt . ' comment ' . $cmt . ' <br>';
        $data = fopen('idpost.log', 'a');
        fwrite($data, $id_stt . "\n");
        fclose($data);
      }

    }

  }
  function auto($url, $cookie, $post = '') {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, 'NokiaC3-00');
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    if ($post) curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
  }

?>
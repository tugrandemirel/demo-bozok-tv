<footer id="footer">
    <div class="container">
        <div class="endline">
            <div class="logo">
                <a href="{{ route("front.index") }}" title="En Son Haber" class="logo-bg" style="background: url({{ asset($general_setting?->logo["path"]) }})"><span>En Son Haber</span></a>
            </div>
            <div class="slogan">
                Copyright &copy; {{ \Carbon\Carbon::now()->format('Y') }} {{ $general_setting?->site_name }} Tüm Hakları Saklıdır.
            </div>
            <div class="social-links">
                <a href="https://t.me/ensonhaber" target="_blank" rel="nofollow" class="telegram"
                   title="Ensonhaber Telegram kanalı"><span>Telegram</span></a>
                <a href="https://wa.me/905333782000" target="_blank" rel="nofollow" class="whatsapp"
                   title="Ensonhaber whatsapp hattı"><span>WhatsApp</span></a>
                <a href="https://www.youtube.com/channel/UCZHf28-BG2Pz-UFqYJiZBeg" target="_blank" rel="noopener"
                   class="youtube" title="Ensonhaber Youtube"><span>Youtube</span></a>
                <a href="https://twitter.com/ensonhaber" target="_blank" class="twitter"
                   title="Ensonhaber Twitter"><span>Twitter</span></a>
                <a href="https://www.instagram.com/ensonhaber/" target="_blank" class="instagram"
                   title="Ensonhaber Instagram"><span>Instagram</span></a>
                <a href="https://www.facebook.com/ensonhaber" target="_blank" class="facebook"
                   title="Ensonhaber facebook"><span>Facebook</span></a>
            </div>
        </div>
    </div>
    <!-- footer menu -->
    <div id="footer-menu">
        <div class="container">
            <div class="grid grid-5">
                <div class="item">
                    <ul>
                        <li><a href="index.html">HABERLER</a></li>
                        <li><a href="gundem">Gündem</a></li>
                        <li><a href="politika.html">Politika</a></li>
                        <li><a href="ekonomi">Ekonomi</a></li>
                        <li><a href="dunya.html">Dünya</a></li>
                    </ul>
                </div>
                <div class="item">
                    <ul>
                        <li><a href="yazarlar/index.html">Yazarlar</a></li>
                        <li><a href="otomobil.html">Otomobil</a></li>
                        <li><a href="teknoloji.html">Teknoloji</a></li>
                        <li><a href="medya.html">Medya</a></li>
                        <li><a href="kralspor.html">Spor Haberleri</a></li>
                    </ul>
                </div>
                <div class="item">
                    <ul>
                        <li><a href="yasam.html">Yaşam</a></li>
                        <li><a href="3-sayfa">3.Sayfa</a></li>
                        <li><a href="magazin.html">Magazin</a></li>
                        <li><a href="emlak.html">Emlak</a></li>
                        <li><a href="kadin">Kadın</a></li>
                    </ul>
                </div>
                <div class="item">
                    <ul>
                        <li><a href="egitim-haberleri.html">Eğitim</a></li>
                        <li><a href="tarih-haberleri.html">Tarih</a></li>
                        <li><a href="seyahat">Seyahat</a></li>
                        <li><a href="kitap.html">Kitap</a></li>
                        <li><a href="kultur-sanat.html">Kültür Sanat</a></li>
                    </ul>
                </div>
                <div class="item">
                    <ul>
                        <li><a href="saglik">Sağlık</a></li>
                        <li><a href="bilgi">Bilgi</a></li>
                        <li><a href="namaz-vakitleri.html">Namaz Vakitleri</a></li>
                        <li><a href="biyografi.html">Biyografi</a></li>
                        <li><a href="foto-galeri.html">Foto Galeri</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- //footer menu -->
    <!-- bottom -->
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="column">
                    <div class="firstline">
                        <a href="hakkimizda">Hakkımızda</a>
                        <a href="veri-politikasi.html">KVKK Politikası</a>
                        <a href="gizlilik-sozlesmesi.html">Gizlilik Sözleşmesi</a>
                        <a href="iletisim.html">Bize Ulaşın</a>
                        <a href="kunye.html">Künye</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //bottom -->
</footer>

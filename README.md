# Detaylandırılmış ToDo List Web Uygulaması

# Proje Hakkında
Bu proje sisteme kayıt olup giriş yapan kullanıcıların günlük, haftalık ve aylık planlarını planlamalarını ve kontrol edebilmelerini; bir takım notlar alabilmelerini sağlayan bir projedir. Bu Projede PHP Web Programlama dilinin yanı sıra arayüz tasarımları için Bootstrap 5 kütüphanesi kullanılmıştır.

# Projede bulunan sistemler hk.
# Giriş Kayıt Sistemi
✅Tam kontrollü ve güvenli bir giriş-kayıt sistemi projede bulunmaktadır. Kullanıcıların sisteme giriş yaparken karşılacağı sorunlar detaylı bir şekilde kullanıcının önüne serilmektedir. Bu mesajları görüntülemek için kodun bakımı ve proje dosyalarının yönetilmesi açısından _messsages.php dosyası kullanılmaktadır.

# İstatistik Sistemi
✅index.php dosyası içerisinde kullanıcının kaç not oluşturmak hakkı kaldığı, kaç tane not oluşturduğu, oluşturduğu notun yüzdelik oranı, en son oluşturulan not bilgisi ve profil bilgisi gibi istatistikler index.php dosyası içerisinde anlaşılabilir bir dilde anlatılmıştır.

# Not Oluşturma Sistemi
✅Sidebar da bulunan Not oluştur kısmına veya Notlarım kısmına gidip sol alt köşe deki + butonuna tıklayıp Not oluşturma Açılır Penceresini(Modal) çağırabilirsiniz. Çağırdığınız zaman karşınızda Not başlığı, Not içeriği ve Not arkaplan rengini seçebileceğiniz bir arayüz karşılamaktadır. Bu arayüz içerisinde sizi engelleyecek tek koşul Not başlığınız 20 karakterden fazla olmamalıdır. Not oluştur butonuna tıkladığınızda sizi notlar.php sayfasına gönderecektir ve notlarınız listelenecektir.
#UYARI
❗️❗️❗️❗️❗️#NOT: NOT BAŞLIK VE NOT İÇERİK BİLGİLERİNİZ VERİ TABANINDA AES-128-CBC OLARAK ŞİFRELENMEKTEDİR!

# Not Okuma Sistemi
✅notlar.php sayfasında veya sidebar da bulunan Notlarım kısmına tıklayıp notlarınızı görüntülüyorsunuz. Görüntüledikten sonra herhangi bir notun üzerine tıklayıp notu okuyabilirsiniz. Bu arayüzde Notunuzu Düzenleme ve Silme gibi işlevleri olan seçenekler bulunmaktadır.

# Not Silme Sistemi
✅Notlarınızı okuduğunuz alanda bulunan sil seçeneğine tıklayarak bir diğer açılır pencere(modal) yapısı karşınızaa çıkar ve 'Gerçekten silmek istiyor musunuz?' sorunu sorar silmek isterseniz Evet seçeneğini seçebilirsiniz.

# Not Düzenleme Sistemi
✅Notlarınızı okuduğunuz alanda bulunan Düzenle seçeneğine tıklayarak bir diğer bir açılır pencere(modal) yapısı olan not düzenleme arayüzü karşınıza çıkar ve buradan not başlığınızı, not içeriğinizi ve not arkaplan rengini düzenle seçeneğine tıklayarak düzenleyebilirsiniz.

# Profil Sistemi
✅İlk kez hesap oluşturduğunuz zaman profiliniz oluşmaz. Bu isteğe bağlı olarak belirlenmiştir. Profilinizi oluşturmak için 'Ana Sayfada(index.php)' veya sidebardaki 'Profil' kısmına tıklayarak profilinizi oluşturabilirsiniz. Bu alanda size Ad, Soyad, Cinsiyet ve profil resmi gibi bilgiler istenmektedir. Bu bilgileri girip profilinizi oluşturabilirsiniz veya daha sonrasında profilinizi güncellemek istediğinizde tekrardan güncelleyebilirsiniz.

# Çıkış Yapma Sistemi
✅sidebarda bulunan Çıkış seçeneğini seçerek karşınıza çıkan Açılır pencere(modal) yapısı ile hesabınızdan çıkış yapabilirsiniz.


# Proje kurulumu
-- Eklenecek

## Lisans
Bu proje MIT lisansı ile lisanslanmıştır – detaylar için LICENSE dosyasına bakın.

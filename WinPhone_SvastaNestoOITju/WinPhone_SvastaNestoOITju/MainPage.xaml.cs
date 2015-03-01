using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Navigation;
using Microsoft.Phone.Controls;
using Microsoft.Phone.Shell;
using WinPhone_SvastaNestoOITju.Resources;
using System.Text;
using System.IO;
using System.Runtime.Serialization.Json;

namespace WinPhone_SvastaNestoOITju
{
    public partial class MainPage : PhoneApplicationPage
    {


        private WebClient client = new WebClient();
        public MainPage()
        {
            InitializeComponent();
        }
        private void Button_Click(object sender, RoutedEventArgs e)
        {
            client.DownloadStringCompleted += new DownloadStringCompletedEventHandler(loadHTMLCallback);
            client.DownloadStringAsync(new Uri("http://web.ffos.hr/oziz/svastanestooit/zbroji.php?tko=winphone&pbroj=" + txtPrviBroj.Text + 
                "&dbroj=" + txtDrugiBroj.Text));
        }

        public void loadHTMLCallback(Object sender, DownloadStringCompletedEventArgs e)
        {
            try
            {
                Console.WriteLine(e.Result);
                byte[] data = Encoding.UTF8.GetBytes(e.Result);
                MemoryStream memStream = new MemoryStream(data);
                DataContractJsonSerializer serializer = new DataContractJsonSerializer(typeof(Podaci));
                Podaci p = (Podaci)serializer.ReadObject(memStream);

                lblRezultat.Text = Convert.ToString(p.rezultat);
            }
            catch (Exception ex)
            {
                var pb = Int16.Parse(txtPrviBroj.Text);
                var db = Int16.Parse(txtDrugiBroj.Text);
                lblRezultat.Text = Convert.ToString(pb+db);
            }
        }

        // Sample code for building a localized ApplicationBar
        //private void BuildLocalizedApplicationBar()
        //{
        //    // Set the page's ApplicationBar to a new instance of ApplicationBar.
        //    ApplicationBar = new ApplicationBar();

        //    // Create a new button and set the text value to the localized string from AppResources.
        //    ApplicationBarIconButton appBarButton = new ApplicationBarIconButton(new Uri("/Assets/AppBar/appbar.add.rest.png", UriKind.Relative));
        //    appBarButton.Text = AppResources.AppBarButtonText;
        //    ApplicationBar.Buttons.Add(appBarButton);

        //    // Create a new menu item with the localized string from AppResources.
        //    ApplicationBarMenuItem appBarMenuItem = new ApplicationBarMenuItem(AppResources.AppBarMenuItemText);
        //    ApplicationBar.MenuItems.Add(appBarMenuItem);
        //}
    }
}
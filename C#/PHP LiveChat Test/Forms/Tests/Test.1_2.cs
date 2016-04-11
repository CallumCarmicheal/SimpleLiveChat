using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Net;
using System.Collections.Specialized;

namespace PHPLiveChat.Forms.Tests {
    public partial class Test_1And2 : Form {
        public Test_1And2() {
            // Wait for the WebClient to resolve the proxy and DNS
            wc = new WebClient { Proxy = null };
            string chat = wc.DownloadString(Location);
        
            string pollValue = wc.DownloadString(Location + "?method=poll");

            // Start the GUI
            InitializeComponent();

            richTextBox1.Text = chat;
        }


        string Location = "http://localhost:8080/Tests/dotNet.LiveChat/Test.1.php";
        WebClient wc = new WebClient { Proxy = null };
        string lastPol = "";

        private void button1_Click(object sender, EventArgs e) {
            string chat = wc.DownloadString(Location);
            richTextBox1.Text = chat;
        }

        private void textBox1_TextChanged(object sender, EventArgs e) { }

        private void textBox1_KeyUp(object sender, KeyEventArgs e) {
            if(e.KeyData == Keys.Enter) {
                NameValueCollection nvc = new NameValueCollection();
                nvc.Add("name", "C#");
                nvc.Add("msg", textBox1.Text);

                wc.UploadValues(Location, "post", nvc);
                textBox1.Text = "";
                button1_Click(null, null);
            }
        }

        private void Polling_Tick(object sender, EventArgs e) {
            // This will be async but for now this is just in the same thread
            //

            string pollValue = wc.DownloadString(Location + "?method=poll");

            if (lastPol != pollValue)
                button1_Click(null, null);

            lastPol = pollValue;
        }

        private void Test_1_Shown(object sender, EventArgs e) {
            // Start polling
            Polling.Start();
        }

        private void richTextBox1_TextChanged(object sender, EventArgs e) {
            richTextBox1.SelectionStart = richTextBox1.Text.Length;
            richTextBox1.ScrollToCaret();
        }

        private void radioButton1_CheckedChanged(object sender, EventArgs e) {
            if ((sender as RadioButton).Checked)
                Location = "http://localhost:8080/Tests/dotNet.LiveChat/Test.1.php";
        }

        private void radioButton2_CheckedChanged(object sender, EventArgs e) {
            if((sender as RadioButton).Checked)
                Location = "http://localhost:8080/Tests/dotNet.LiveChat/Test.2.php";
        }
    }
}

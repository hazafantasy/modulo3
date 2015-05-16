package bluespark.citalin.modulo3;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;


public class MainActivity extends Activity
{
    private WebView mWebView;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        mWebView = (WebView) findViewById(R.id.activity_main_webview);
        // Enable Javascript
        WebSettings webSettings = mWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);

        //Carga una WEB
        mWebView.loadUrl("http://modulo3.citalin.com");

        //Set the web view client using a domain
        //Every call to another page of this domain will be handled inside
        //our webView. If the page to call is outside the domain then pop for default web browser
        mWebView.setWebViewClient(new MainWebViewClient("modulo3.citalin.com"));
    }



    @Override
    public boolean onCreateOptionsMenu(Menu menu)
    {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item)
    {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @Override
    public void onBackPressed()
    {
        if(mWebView.canGoBack())
        {
            mWebView.goBack();
        }
        else
        {
            super.onBackPressed();
        }
    }



    //PRIVATE CLASSES
    //**********************************************************************************************
    //**********************************************************************************************
    private class MainWebViewClient extends WebViewClient
    {
        //Este sera el host que manejara la app
        private String host = "";

        public MainWebViewClient(String host)
        {
            super();
            this.host = host;
        }

        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url)
        {
            if(Uri.parse(url).getHost().endsWith(host))
            {//Si la URL a la cual se desea accesar esta dentro del dominio:
                //No redireccionar y manejar la llamada dentro del WebView
                return false;
            }

            Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(url));
            view.getContext().startActivity(intent);
            return true;
        }

        @Override
        public void onPageStarted (WebView view, String url, Bitmap favicon)
        {
            //Haz aqui algo cuando la pagina comience a cargar
            //Puedes colocar alguna clase de spinner o barra
            Log.wtf("MainActivity", "Acabas de entrar a onPageStarted(...)");//What da fuck debbug
        }

        @Override
        public void onPageFinished (WebView view, String url)
        {
            //Haz aqui algo cuando la pagina termine de cargar
            //Esconde el Spinner or so.
            Log.wtf("MainActivity", "Acabas de entrar a onPageFinished(...)");//What da fuck debbug
        }

    }
}

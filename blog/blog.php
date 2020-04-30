https://webdesignledger.com/using-htaccess-make-url-seo-friendly/

function title($string)
{
    $string = preg_replace('/^a-z0-9/', '-', strtolower($string ));
    return $string;
}

There are two ways you can make human readable URLs in PHP. One, by using Request_URi method and second via the .htaccess file. In this tutorial, I will be coming up with SEO friendly URLs for the blog using a .htaccess file. You can use the same practice to create the same for any store.

Let’s get started.

Let us suppose you are running a blog which is developed using custom PHP code. So, whenever you insert a new post on your blog, then the URL will be generated like this:

www.yoursite.com/index.php?blog_id=1234

In this tutorial, we will be changing the above URL to this:

www.yoursite.com/my-seo-url/


So whenever a person runs the above URL, the same content will be generated as generated when you are giving a blog ID to URL.

Step 1: Changes in Table
First, you need to alter your table in which your article is saved. Create a new column in it and name it seo-url.

Step 2: Function to Make SEO Friendly URL
Let us create a function which will generate SEO friendly URL for you based on the article title.

  
function seo_url($vp_string)

    {

        $vp_string = trim($vp_string);

        $vp_string = html_entity_decode($vp_string);

        $vp_string = strip_tags($vp_string);

        $vp_string = strtolower($vp_string);

        $vp_string = preg_replace('~[^ a-z0-9_.]~', ' ', $vp_string);

        $vp_string = preg_replace('~ ~', '-', $vp_string);

        $vp_string = preg_replace('~-+~', '-', $vp_string);

        $vp_string .= "/";

        return $vp_string;

    }
    
The above function will take article title as a string and return SEO URL. Like this:

my-SEO-URL/

You need to save this URL in the same column which we created in the previous step.

Step 3:  Changes in .htaccess file
Since we have generated an SEO URL, let us make some changes in .htaccess which will redirect the URL to the content that is saved in the database. If you haven’t created any, then create a new file and name it .htaccess. Now paste the following code in it:

RewriteEngine On
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteRule ^(([A-Za-z0-9]+[-]+[A-Za-z0-9]+)+[/])$  index.php?blog_url=$1    [NC,L]    # Handle blog requests
Let’s understand the above code step by step:


The first line is telling Apache that we are going to rewrite some rules

RewriteEngine On
The second and third line is a condition which is checking that the calling URL is not a file or directory name. If it is one of them, the URL will not be rewritten.

RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f
And the last line is our rewrite URL. Now here’s how this is working: The word after RewriteURL  “^(([A-Za-z0-9]+[-]+[A-Za-z0-9]+)+[/])$” is a Regex expression which checks the URL after the “slash(/)” of a complete domain name. You can use this site to learn more about Regex.

Now if the URL is matched by Regex expression the matched URL will then be redirected to index.php?blog_url=(matched URL) in the blog_url variable.

Note: If there is an error in .htaccess file you will get 500 internal server error.

Step 4: Changes in Index File
Now in URL index.php file you will get this URL using $_GET[‘blog_url’] and match this URL from your table and can show the full article quickly. For example, in your index.php file your database query will be changed into this:

$url = $_GET['blog_url'];

$query = "SELECT articles.article_name,articles.article_content,categories.category_name,articles.img,users.u_fname,users.u_lname,DATE_FORMAT(articles.date,'%d %b, %Y') as dates

FROM article

INNER JOIN users

ON users.user_id = article.user_Id

INNER JOIN articles

ON articles.article_id = article.article_id

INNER JOIN categories

ON categories.category_id = articles.category_id

WHERE articles.url = '$url'";
And all things will remain the same. When you run your new URL, you will get the same content as you are getting when sending blog IDs.

Summary
In the article above, I have taught you how to create SEO friendly URLs, what changes will be required and how to redirect the URL. If you are unable to understand it through my article, feel free to contact me or leave a comment below. I’ll get back to you as soon as I can.
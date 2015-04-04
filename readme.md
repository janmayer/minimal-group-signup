# Minimal Group Signup

## A PHP, CSV & jQuery based registration form for groups with size limit.


[See the demo here.](https://www.ikp.uni-koeln.de/~jmayer/github/minimal-group-signup/registration.php)

The form comes with frontend and backend validation and can be configured via `config.inc.php`, see comments. A dedicated database is not required, all data is handled via CSV.


### FAQ

#### The script is not working!
Make sure that your server can access the `.php` and `.htaccess` files, and can write to the `.csv` files. Use e.g. `chmod` to set permissions.

####  Why is the group.csv file rewritten every time? Isn't there a race condition possible?
PHP doesn't support simple file line based editing like your text editor. The script was used for 300 students over the course of one day, no technical problems were found. If you expect several submits within fractions of a second, you should probably use a database.

#### The form doesn't load, i get a strange error!

#### What happens if someone inputs irregular chars or spam? I don't see input sanitizing?

#### I don't see any assets in the repository?
This from uses public [content delivery networks](http://en.wikipedia.org/wiki/Content_delivery_network) providing jQuery (and plugins) as well as the bootstrap CSS (and assets), thus the number of files can be kept minimal.


### MIT Open Source License

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

# Minimal Group Signup

## A PHP, CSV & jQuery based registration form for groups with size limit.

This script provides a possibility for users to register for groups with a size limit. If a user signs up for a group, its size will be incremented. Once the maximum capacity is reached, it can no longer be choosen.

[See the demo here.](https://www.ikp.uni-koeln.de/~jmayer/github/minimal-group-signup/registration.php)

The form comes with frontend and backend validation and can be configured via `config.inc.php`, see comments. A database is not required, all data is handled via CSV.


### FAQ

#### Nothing works!
Make sure that your server can access the `.php` and `.htaccess` files, and can write to the `.csv` files. Use e.g. `chmod` to set permissions.

####  Why is the group.csv file rewritten every time? Isn't there a race conditon possible?
PHP doesn't support simple file line based editing like your text editor. The script was used for 300 students over the course of one day, no technical problems were found. I you expect several submits within fraction of a second, you should probably use something more sophisticated.

#### The form doesn't load, i get a strange error!
By default, a `http://` connection is redirected to its `https://` variant via `mod_rewrite`. If your server does not support secure connections, you can remove the offending part in the `.htaccess`. This is not recommended, as the user input will be transmitted in plain text.

#### What happens if someone inputs irregular chars or spam? I don't see input sanitizing?
To prevent spam or fuzzy attacks, a maximal number of chars should be used for all input field. The build in CSV encode/decode are used to handle special chars, especially chars used in the CSV "syntax" (e.g. `;`) will (should) be escaped automatically.

#### The Website looks nice, but i don't see the assets in the repository?
This from uses public [content delivery networks](http://en.wikipedia.org/wiki/Content_delivery_network) providing jQuery (and plugins) as well as the bootstrap CSS (and assets), thus the number of files can be kept minimal.




### MIT Open Source License

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
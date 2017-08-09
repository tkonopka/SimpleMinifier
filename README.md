# SimpleMinifier

SimpleMinifier is a fast, hassle-free tool for code minification that 
runs with php. It reads js and css files as input and returns smaller, i.e. 
minified, versions as output.


## Implementation

### Main features

 - SimpleMinifier is a self-contained program and does not have any 
dependencies. It performs its intended purpose using only the code included in 
this repo; there are no installation/preparation steps required. This makes the 
program usable in many environments. 

 - SimpleMinifier has a small footprint. The core of the program is implemented 
in a single php class and a command-line executable is implemented in a second 
file. This facilitates direct (copy-paste) integration with larger projects.

 - SimpleMinifier is fast. Its speed is due to the fact that it does not 
attempt difficult optimizations. This makes the tool convenient for development.


### Main drawback

 - SimpleMinifier implements only a subset of possible optimizations for code 
size. It removes comment blocks, comment lines, and redundant 
white space. However, it retains some white space and does not shorten local 
variable names. Therefore, the minified files output by SimpleMinifier may be 
slightly larger than those produced by a full-featured minifier like uglifyjs 
(e.g. input: 25K, SimpleMinifier: 14K, uglifyjs: 13K).


## Alternatives

The features and drawbacks together make SimpleMinifier a convenient tool for 
development and for simple applications. For complex projects, there are 
alternative minifiers that require installation of additional components. 
Examples include [uglifyjs](https://github.com/mishoo/UglifyJS) (js), 
[uglifycss](https://github.com/fmarcia/UglifyCSS) (js), 
[minify](https://github.com/matthiasmullie/minify) (php).



## License

MIT license.


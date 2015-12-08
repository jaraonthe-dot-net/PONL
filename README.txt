PONL - PHP on line

PHP on line is a framework to use php scripts on the command line.

Instead of tinkering with proprietary cli scripting languages, you can write
them in php. The framework then makes them available on the commandline with the
command ponl.

PONL is mainly targeted at Windows OS, but it may be useful on Linux/Unix as
well.

To make a php script available, change the extension to .ponl or .ponl.php and
place it in the subdirectory /scripts.

PONL also offers a man page system. Every script can supply its own help page.


=REQUIREMENTS=

- PHP 5.0.0. or later
- Windows OS (for now)


=SETUP=

Note: Only Windows is supported for now.

- Put all PONL files in a directory of your choosing.
- Edit the Path environment variable (somewhere under System Properties):
	+ Make sure that your installation of PHP is in the path
	+ Ensure that typing 'php' in the command line runs the php exe.
	+ Add the directory where you installed PONL to the path.

- Now, by typing 'PONL' in the command line, you can run ponl. It should output
a message like this: "PON: No command specified. Type 'ponl help' for details."

- Installation complete. Start using PONL.


=USAGE=

To make a php script available, change the extension to .ponl or .ponl.php and
place it in the subdirectory scripts/. It will be available on the command line
via the 'ponl' command. The script is identified with its filename (minus the
extension). To call it, type 'ponl <script>'. If you're ever in doubt which
scripts are available or how they are called, consult 'ponl help' for a list.

You can arrange your scripts in subdirectories within the scripts/ directory.
This allows for software packages with whole sets of scripts. You can also add
additional files or php scripts, just as long as they don't have an extension
.ponl or .ponl.php.


=DEPLOYED/=

Usually, you should put your scripts into the scripts/ directory. However, you
can also use the deployed/ directory for special purpose. For instance, if you
want to use PONL as part of your own software, you could put your relevant
software scripts into the deployed/ directory.

You should never, however, put your own scripts into the built-in/ directory. It
is reserved for scripts belonging to ponl itself.


=MAN PAGE=

Every script file can contain a man page. For this, put your help text into a
doc comment within the file (A doc comment is a multi-line comment that starts
with '/**'). To be recognised by ponl, the comment must start with
'/** man page'. Please consider that the comment's first and last lines are
discarded in the output, so you should follow this format:

/** man page
 * Help thext here.
 *
 * Some more text.
*/

The comment can be anywhere in the file, but only one of them per file is
possible.

To call the man page, type 'ponl man <script>'.


=COPYRIGHT&LICENSE NOTICE=

This Readme was written by Jakob Rathbauer. Last modified on 2015-12-08.

PONL - PHP on line
Copyright (C) 2015 Jakob Rathbauer <ponl@software.jaraonthe.net>.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
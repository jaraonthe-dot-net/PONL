<?php
/*
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
*/


/** man page
 * PHP on line (short: PONL) makes PHP scripting available on the command line.
 * You can easily code a short (or longer) application in your favourite
 * programming language and execute it on the command line like any native
 * application.
 *
 * To execute one such application (or 'command') you have to enter
 * 'ponl' + the command name (see below).
 *
 * If you want to get more information about a command, simply type
 * 'ponl man' + the command name. This will display the corresponding man page.
 *
 *
 * A list of all available commands:
 *
 * %commandList
 *
 *
 * --
 * PONL - PHP on line
 * Copyright (C) 2015 Jakob Rathbauer <ponl@software.jaraonthe.net>.
 * This program comes with ABSOLUTELY NO WARRANTY; it is free software under the
 * terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
*/

// Note: working directory is not touched. File references relative to THIS file
//  have to be done with dirname(__FILE__).


// can be feed with more than one dir. Earlier dirs will take precedence in case of collision
function scan4Scripts($S_dir)
{
    // TODO: Error handling
    
    if (func_num_args() > 1) {
        $A_commands = array();
        
        foreach (func_get_args() as $S_arg) {
            $A_commands = array_merge(scan4scripts($S_arg), $A_commands);
        }
        return $A_commands;
    }
    
    // TODO: what with several scripts evaluating to the same command name?
    //       Which will get precedence? Are all callable, and: how?
    
    $S_dir = rtrim($S_dir, '/\\');
    
    // key: command name => value: path of file (based on $S_dir).
    $A_commands = array();
    $R_dir = opendir($S_dir);
    while (($S_entry = readdir($R_dir)) !== false) {
        if (in_array($S_entry, array('.', '..'))) {
            continue;
        }
        if (is_dir($S_dir. '/' .$S_entry)) {
            $A_commands = array_merge(scan4Scripts($S_dir. '/' .$S_entry), $A_commands);
        } else {
            
            foreach (array('.ponl.php', '.ponl') as $S_ext) {
                if (strrpos($S_entry, $S_ext) === strlen($S_entry) - strlen($S_ext)) {
                    $A_commands[substr($S_entry, 0, -strlen($S_ext))] = realpath($S_dir . '/' . $S_entry);
                    break;
                }
            }
        }
    }
    return $A_commands;
}


function runScript(
    $S_file,
    $argv,
    $argc,
    $A_ponlCommands,
    $A_ponlCommandsBuiltIn,
    $A_ponlCommandsDeployed,
    $A_ponlCommandsScripts
) {
    require_once $S_file;
}



// No command given
if ($argc < 2) {
    print "PONL: No command specified. Type 'ponl help' for details.\r\n";
} else {
    $A_commands = scan4scripts(
        dirname(__FILE__) . '/built-in',
        dirname(__FILE__) . '/deployed',
        dirname(__FILE__) . '/scripts'
    );
    
    if (in_array($argv[1], array_keys($A_commands))) {
        $A_commandArgs = $argv;
        array_shift($A_commandArgs);
        $A_commandArgs[0] = $A_commands[$argv[1]];
        
        runScript(
            $A_commands[$argv[1]],
            $A_commandArgs,
            count($A_commandArgs),
            $A_commands,
            scan4scripts(dirname(__FILE__) . '/built-in'),
            scan4scripts(dirname(__FILE__) . '/deployed'),
            scan4scripts(dirname(__FILE__) . '/scripts')
        );
    } else {
        die("PONL: Command not found. Type 'ponl help' for a list of all available commands.\r\n");
    }
}

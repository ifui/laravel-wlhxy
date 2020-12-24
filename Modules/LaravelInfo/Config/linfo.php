<?php

// If you experience timezone errors, uncomment (remove //) the following line and change the timezone to your liking
// date_default_timezone_set('America/New_York');
return [
    'byte_notation' => 1024, // Either 1024 or 1000; defaults to 1024
    'dates' => 'm/d/y h:i A (T)', // Format for dates shown. See php.net/date for syntax
    'language' => 'zh', // Refer to the lang/ folder for supported languages
    'icons' => true, // simple icons,
    'theme' => 'default', // Theme file (layout/theme_$n.css). Look at the contents of the layout/ folder for other themes.
    'gzip' => false, // Manually gzip output. Unneeded if your web server already does it.
    'allow_changing_themes' => false, // Allow changing the theme per user in the UI?
    /**
     * Possibly don't show stuff
     */

    // For certain reasons, some might choose to not display all we can
    // Set these to true to enable; false to disable. They default to false.
    'show' => [
        'kernel' => true,
        'ip' => true,
        'os' => true,
        'load' => true,
        'ram' => true,
        'hd' => true,
        'mounts' => true,
        'mounts_options' => false, // Might be useless/confidential information; disabled by default.
        'webservice' => true, // Might be dangerous/confidential information; disabled by default.
        'phpversion' => true, // Might be dangerous/confidential information; disabled by default.
        'network' => true,
        'uptime' => true,
        'cpu' => true,
        'process_stats' => true,
        'hostname' => true,
        'distro' => true, // Attempt finding name and version of distribution on Linux systems
        'devices' => true, // Slow on old systems
        'model' => true, // Model of system. Supported on certain OS's. ex: Macbook Pro
        'numLoggedIn' => true, // Number of unqiue users with shells running (on Linux)
        'virtualization' => true, // whether this is a VPS/VM and what kind
        'duplicate_mounts' => true,
        'temps' => false,
        'raid' => false,
        'battery' => false,
        'sound' => false,
        'wifi' => false,
        'services' => false,
    ],
    // CPU Usage on Linux (per core and overall). This requires running sleep(1) once so it slows
    // the entire page load down. Enable at your own inconvenience, especially since the load averages
    // are more useful.
    'cpu_usage' => true,
    "hide" => [
        "filesystems" => [
            "tmpfs",
            "ecryptfs",
            "nfsd",
            "rpc_pipefs",
            "proc",
            "sysfs",
            "usbfs",
            "devpts",
            "fusectl",
            "securityfs",
            "fuse.truecrypt",
            "cgroup",
            "debugfs",
            "mqueue",
            "hugetlbfs",
            "pstore",
            "rootfs",
            "binfmt_misc",
        ],
        "storage_devices" => [
            "gvfs-fuse-daemon",
            "none",
            "systemd-1",
            "udev",
        ],
        "mountpoints_regex" => [],
        "fs_mount_options" => [
            "ecryptfs",
        ],
        "sg" => true,
        "dont_resolve_mountpoint_symlinks" => false,
    ],
    "raid" => [
        "gmirror" => false,
        "mdadm" => false,
    ],
    "temps" => [
        "hwmon" => true,
        "thermal_zone" => false,
        "hddtemp" => false,
        "mbmon" => false,
        "sensord" => false,
    ],
    "temps_show0rpmfans" => false,
    "hddtemp" => [
        "mode" => "daemon",
        "address" => [
            "host" => 'localhost',
            "port" => 7634,
        ],
    ],
    "mbmon" => [
        "address" => [
            "host" => "localhost",
            "port" => 411,
        ],
    ],
    /**
     * For the things that require executing external programs, such as non-linux OS's
     * and the extensions, you may specify other paths to search for them here:
     */
    "additional_paths" => [
        //'/opt/bin' # for example
    ],
    /**
     * Services. It works by specifying locations to PID files, which then get checked
     * Either that or specifying a path to the executable, which we'll try to find a running
     * process PID entry for. It'll stop on the first it finds.
     */

    "services" => [
        "pidFiles" => [
            // 'Apache' => '/var/run/apache2.pid', // uncomment to enable
            // 'SSHd' => '/var/run/sshd.pid'
        ],
        "executables" => [
            // 'MySQLd' => '/usr/sbin/mysqld' // uncomment to enable
            // 'BuildSlave' => array('/usr/bin/python', // executable
            //                        1 => '/usr/local/bin/buildslave') // argv[1]
        ],
    ],

    /**
     * Debugging settings
     */

    // Show errors? Disabled by default to hide vulnerabilities / attributes on the server
    "show_errors" => false,
    // Show results from timing ourselves? Similar to above.
    // Lets you see how much time getting each bit of info takes.
    "timer" => false,
    // Compress content, can be turned off to view error messages in browser
    "compress_content" => true,
    /**
     * Occasional sudo
     * Sometimes you may want to have one of the external commands here be ran as root with
     * sudo. This requires the web server user be set to 'NOPASS' in your sudoers so the sudo
     * command just works without a prompt.
     *
     * Add names of commands to the array if this is what you want. Just the name of the command;
     * not the complete path. This also applies to commands called by extensions.
     *
     * Note: this is extremely dangerous if done wrong
     */
    "sudo_apps" => [],
];

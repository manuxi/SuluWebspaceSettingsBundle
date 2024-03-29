*Work in progress! Only for test! Use at own risk.*

-----
Currently only one (hardcoded => "sulu-test") webspace is used, since no correct access to request data, which is needed to determine the current workspace.

The security system is deactivated also since in the WebspaceSettingsAdmin there is no access to current webspace also.

-----

The settings are accessible trough the webspace.

In twig do the following:

````
{% dump load_webspace_setting("sulu-test") %}
````

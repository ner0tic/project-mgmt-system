###Project Management System
This is a CMS for development projects.

##Install
Add to `composer.json` file:

```js
"ner0tic/project-mgmt-system": "dev-master"
```
Update composer:
```bash
php composer.phar update ner0tic/project-mgmt-system
```

##Usage
Set your initial admin user data and then just add/remove any entity objects you might need.

##In-depth
#Users
There are three different user types.  Each affords access to different portals and aspects of the system.
-Admin
  -Can add clients, developers, projects, project categories and project statuses to the system.  Can also promote developers and assign to various projects.
-Developer
  -Can use a generated portfolio basd upon projects they're assigned to.
-Client
  -Can see status changes for various projects associated to them.

#Projects
Projects consist of a name, description and url and then are linked to supplied categories, statuses, clients and developers to create a useful base for an achitechture to management development flow.
-Category
  -May have a parent, categorizes the given projects for ease of sorting, editing and searching.
-Status
  -Shows varying stages of developement to clients, users, and viewers of projects within the system.


##Addons
#Project Punchclock
Punchclock system to track developers work and generate accurate billing statements.

#Project Billing
Billing system for developers, firms and the like to genereate invoicing for clients.


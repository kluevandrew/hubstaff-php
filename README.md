Hubstaff PHP Client
A PHP toolkit for Hubstaff API.

Installation

Include the hubstaff.php file in your project

Use your personal APP_TOKEN found in your account settings to the config file.

  define("App_Token","<Hubstaff Application Token>");
  define("email","<Hubstaff Account Email>");
  define("password","<Hubstaff Account Password>");

## Usage

Calls for Hubstuff API v1 are relative to the base url https://api.hubstaff.com/v1/

API actions are available as methods on the client object. Currently, the Hubstaff client has the following methods:

| Action               	                   | Method             					                           |
|:-----------------------------------------|:--------------------------------------------------------|
| **Users**                                |                   					                             |
| List users          	                   | `#users(org_member, project_member, offset)`            |
| Find a user          	                   | `#find_user(user_id)`                                   |
| Find a users organizations    	         | `#find_user_orgs(user_id, offset)`                      |
| Find a users projects                    | `#find_user_projects(user_id, offset)`                  |
| **Organizations**                        |                   					                             |
| List organizations                       | `#organizations(offset)`                                |
| Find a organization                      | `#find_organization(org_id)`                            |
| Find a organization projects 	           | `#find_org_projects(org_id, offset)`                    |
| Find a organization members              | `#find_org_members(org_id, offset)`                     |
| **Projects**                             |                   					                             |
| List projects                            | `#projects(active, offset)`                             |
| Find a project                           | `#find_project(project_id)`                             |
| Find a project members                   | `#find_project_members(project_id, offset)`             |
| **Activities**                           |                   					                             |
| List activities                          | `#activities(start_time, stop_time, options={})`        |
| **Notes**                                |                   					                             |
| List notes                               | `#notes(start_time, stop_time, options={})`             |
| Find a note                              | `#find_note(note_id)`                                   |
| **Weekly Reports**                       |                   					                             |
| List weekly team report                  | `#weekly_team(options={})`                              |
| List weekly individual report            | `#weekly_my(options={})`                                |
| **Custom Reports**                       |                   					                             |
| List custom team report by date          | `#custom_date_team(start_date, end_date, options={})`   |
| List custom individual report by date    | `#custom_date_my(start_date, end_date, options={})`     |
| List custom team report by member        | `#custom_member_team(start_date, end_date, options={})` |
| List custom individual report by member  | `#custom_member_my(start_date, end_date, options={})`   |
| List custom team report by project       | `#custom_project_team(start_date, end_date, options={})`|
| List custom individual report by project | `#custom_project_my(start_date, end_date, options={})`  |

## Use Cases

Here are some common use cases for the Hubstaff v1 API client.

First configure the ``config.php`` gem with your ``APP_TOKEN``, ``email`` and ``password``.

### List users

List all users and organization or project memberships for each user.

```PHP

include("hubstaff.php");
$hubstaff = new hubstaff();
user = $hubstaff.users(true, true)

# => {"users": [{ "id":..., "organanizations": ["id":...], "projects": ["id":...]}]}

```

### Find a specific user

Users can be looked up by their ``user_id``.

```PHP

include("hubstaff.php");
$hubstaff = new hubstaff();
json_data = $hubstaff.find_user(61188)

# => {"user": { "id":...}}

```

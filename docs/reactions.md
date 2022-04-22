# Reaction endpoints

## Route - /posts/:postId/reactions

### Get All reactions in a post
+ route - /posts/:postId/reactions
+ Method - GET
  
####  Successful response
+ status - 200
``` json
    {
        "success": true,
        "meta":{
            "total": 4
        },
        "data":[
            {
            "id": 1,
            "post_id": 1,
            "user_id": 1,
            "type": "like",
            "created_at": "2022-04-22T06:28:31.000000Z",
            "updated_at": "2022-04-22T06:28:31.000000Z",
            "owner": "Alice",
            "user": {
                "id": 1,
                "name": "Alice",
                "email": "alice@gmail.com",
                "profile": null,
                "email_verified_at": null,
                "created_at": "2022-04-22T06:28:22.000000Z",
                "updated_at": "2022-04-22T06:28:22.000000Z"
            }
        },
        {
            "id": 2,
            "post_id": 1,
            "user_id": 2,
            "type": "unlike",
            "created_at": "2022-04-22T06:28:31.000000Z",
            "updated_at": "2022-04-22T06:28:31.000000Z",
            "owner": "Bob",
            "user": {
                "id": 2,
                "name": "Bob",
                "email": "bob@gmail.com",
                "profile": null,
                "email_verified_at": null,
                "created_at": "2022-04-22T06:28:23.000000Z",
                "updated_at": "2022-04-22T06:28:23.000000Z"
            }
        },
        {
            "id": 3,
            "post_id": 1,
            "user_id": 3,
            "type": "love",
            "created_at": "2022-04-22T06:28:31.000000Z",
            "updated_at": "2022-04-22T06:28:31.000000Z",
            "owner": "John",
            "user": {
                "id": 3,
                "name": "John",
                "email": "john@gmail.com",
                "profile": null,
                "email_verified_at": null,
                "created_at": "2022-04-22T06:28:23.000000Z",
                "updated_at": "2022-04-22T06:28:23.000000Z"
            }
        },
        {
            "id": 4,
            "post_id": 1,
            "user_id": 4,
            "type": "wow",
            "created_at": "2022-04-22T06:28:32.000000Z",
            "updated_at": "2022-04-22T06:28:32.000000Z",
            "owner": "Sue",
            "user": {
                "id": 4,
                "name": "Sue",
                "email": "sue@gmail.com",
                "profile": null,
                "email_verified_at": null,
                "created_at": "2022-04-22T06:28:23.000000Z",
                "updated_at": "2022-04-22T06:28:23.000000Z"
            }
        }
        ]
    }
```
# Comment endpoints

## Route - /posts/:postId/comments

### Get All comments in a post
+ route - /posts/:postId/comments
+ Method - GET
  
####  Successful response
+ status - 200
``` json
    {
        "success": true,
        "meta":{
            "total": 1
        },
        "data":[
            {
                "id": 30,
                "comment_text": "optio",
                "post_id": 1,
                "user_id": 2,
                "created_at": "2022-04-22T06:28:31.000000Z",
                "updated_at": "2022-04-22T06:28:31.000000Z",
                "user": {
                    "id": 2,
                    "name": "Bob",
                    "email": "bob@gmail.com",
                    "profile": null,
                    "email_verified_at": null,
                    "created_at": "2022-04-22T06:28:23.000000Z",
                    "updated_at": "2022-04-22T06:28:23.000000Z"
                }
            }
        ]
    }
```
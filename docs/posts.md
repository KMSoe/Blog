# Post endpoints

## Route - / posts

### Get All posts
+ route - /posts
+ Method - GET

####  Successful response
+ status - 200
``` json
    {
        "success": true,
        "meta":{
            "total": 10
        },
        "data":[
            {
                "id": 1,
                "title": "Nisi beatae aut quia hic corporis.",
                "description": "Velit nesciunt blanditiis autem id eum. Et suscipit repellat aspernatur rerum dolore. Aperiam minima ab nihil sequi rerum consequuntur. Et adipisci exercitationem at est rerum.",
                "image": null,
                "category_id": 6,
                "user_id": 1,
                "created_at": "2022-04-21T15:46:46.000000Z",
                "updated_at": "2022-04-21T15:46:46.000000Z",
                "Owner": "Alice",
                "profile": null,
                "categoryName": "Aliquam",
                "numOfComments": 5,
                "numOfReactions": 1,
                "reactions": [
                    {
                        "id": 1,
                        "post_id": 1,
                        "user_id": 1,
                        "type": "like",
                        "created_at": null,
                        "updated_at": null,
                        "owner": "Alice",
                        "user": {
                            "id": 1,
                            "name": "Alice",
                            "email": "alice@gmail.com",
                            "profile": null,
                            "email_verified_at": null,
                            "created_at": "2022-04-21T15:46:42.000000Z",
                            "updated_at": "2022-04-21T15:46:42.000000Z"
                        }
                    }
                ]
            },
            ...
        ],
    }
 ```

####  Error response
+ status 400 or 500
``` json
{
    "success": false,
    "message": "Something Went Wrong!!!"

}
```

### Create Post
+ route - /posts
+ method - POST
+ Request body
    <ol>
        <li>title</li>
        <li>description</li>
        <li>image (Optional)</li>
        <li>category_id</li>
    </ol>

####  Successful response
+ status - 201
``` json
    {
        "success": true,
        "meta":{
            "id": "post_id", // Created Post id
        },
        "data":[
            {
            }
        ]
    }
```

####  Error responses
Validation errors
+ status - 400
``` json
    {
        "success": false,
        "errors":[
            {
            }
        ],
        "message": "Something Went Wrong!!!"
    }
```
Validation errors
+ status - 400
``` json
    {
        "success": false,
        "errors":[
            {
            }
        ],
        "message": "Something Went Wrong!!!"
    }
```

### Single Post Detail
+ route - /posts/:id (eg. /posts/1)
+ method - GET

Successful Response
+ status - 200
``` json
{
    "success": true,
    "meta": {
        "id": 1
    },
    "data": {
        "id": 1,
        "title": "Nisi beatae aut quia hic corporis.",
        "description": "Velit nesciunt blanditiis autem id eum. Et suscipit repellat aspernatur rerum dolore. Aperiam minima ab nihil sequi rerum consequuntur. Et adipisci exercitationem at est rerum.",
        "image": null,
        "category_id": 6,
        "user_id": 1,
        "created_at": "2022-04-21T15:46:46.000000Z",
        "updated_at": "2022-04-21T15:46:46.000000Z",
        "numOfComments": 5,
        "numOfReactions": 1
    },
    "message": ""
}
```
Not Found Response
+ status - 404
``` json
{
    "success": false,
    "errors": [],
    "message": "Post Not Found"
}
```

### Update Post
+ route - /posts/1/update
+ method - PUT
+ Request body (like creating post)

### Delete Post
+ route - /posts/1/delete
+ method - DELETE

Successful Response
+ status - 204
``` json
{

}
```
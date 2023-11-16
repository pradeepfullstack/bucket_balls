# Bucket and Ball Management System

## _Overview_

This Laravel task involves creating a Bucket and Ball Management System with three forms (Bucket Form, Ball Form, and Bucket Suggestion Form) and a Result Screen. The goal is to efficiently distribute purchased balls into available buckets while minimizing the number of buckets used.


## Task Description

- Bucket Form
- Ball Form
- Bucket Suggestion Form
- Result Screen

Assuming two buckets (A and B) with capacities of 50 and 40 respectively, and red (5 cubic inches) and blue (3 cubic inches) balls are available. If a user purchases 6 red balls and 4 blue balls:

Placing them in bucket B requires using both A and B.
Placing all balls in bucket A leaves some space in A and B remains empty.
If the user later purchases 4 red balls and 3 blue balls:

1 red and 1 blue ball fill up A, and the rest go to B.
The process continues until extra balls cannot fit into available buckets, prompting the user to return them to the shop.


## Implementation Approach

Dillinger uses a number of open source projects to work properly:

- Use Laravel to create three forms (Bucket, Ball, and Bucket Suggestion).
- Implement logic to manage buckets and balls efficiently.
- Develop a Result Screen to display the current state of balls in buckets.
- Provide user notifications for scenarios where extra balls cannot be accommodated.


## Usage

Clone the repository.
Configure the Laravel environment.
Run migrations to set up the database.
Access the APIs using Postman

## Postman collections
use This APIs to access postman collection 
https://api.postman.com/collections/20904624-363ee228-4412-4271-9764-a2e795070bda?access_key=PMAT-01HFBD6DDNZ22GFQ466MEG2WFZ

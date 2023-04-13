# Photogram
Photogram is a web application designed to facilitate photo-sharing among users. Its sleek and intuitive interface, combined with powerful back-end functionality, makes it the ideal platform for sharing photos with friends, family, and colleagues. This document will provide detailed instructions on how to install and run the project, so that you can start sharing your favorite photos today.

> **NOTE:** This project is currently under development and some things might not work as expected.

## Table of Contents
- Getting Started
  - Prerequisites
  - Installation
- Usage
- Contributing

## Getting Started

### Prerequisites

Before starting the project, you will need to have the following packages installed on your machine:

- PHP (v8.0 above)
- NPM
- Composer

### Installation

To install the project dependencies, follow these steps:

1. Change directory to project/grunt/: `cd project/grunt/
`
2. Install project dependencies from package.json: `npm install`
3. Install dependencies with Composer: `composer update`
2. Create config using make_config PHP script: `cd project/ && php make_config`
7. Fill in the prompts to make the Photogram work.
8. Execute `migrations.sql` in your SQL server to create database with necessary tables and fields for photogram.


## Usage

The Photogram application has an intuitive and user-friendly interface that makes it easy to share your photos with others. Once you've logged in to your account, simply click on the upload button and select the images you wish to share. It will guide you through the process of uploading your photos and adding relevant tags and descriptions.

Once your photos are uploaded, they will be visible to other users on the platform. You can browse and search through existing content, and interact with other users by liking their photos.

Overall, Photogram is a powerful yet simple-to-use platform that makes it easy to share your visual creations with the world. Whether you're a professional photographer or just someone who loves to capture and share moments with others, Photogram is the perfect platform for you.

## Contributing

We welcome contributions to the Photogram project! Here are some ways you can get involved:

- Report bugs and suggest new features by creating an issue on our [git repository](https://git.selfmade.ninja/Henry/photogram/-/issues).
- Contribute code by forking the repository, making changes, and submitting a pull request.
- Help improve the documentation by submitting a pull request with your changes.
- Share Photogram with others by spreading the word on social media or in online communities.

Thank you for your interest in contributing to Photogram!
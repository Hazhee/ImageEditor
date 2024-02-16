# Image Editor

The Image Editor is a web-based application that allows users to perform various image editing tasks, such as removing the background, cleaning up images, cropping, replacing backgrounds, upscaling, and generating images from text prompts. The application leverages the ClipDrop API for these editing functionalities.


## Table of Contents

- [Features](#features)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
  - [Remove Background](#remove-background)
  - [Cleanup](#cleanup)
  - [Image Upscaling](#image-upscaling)
  - [Text to Image](#text-to-image)
  - [Crop Image](#crop-image)
  - [Replace Background](#replace-background)
- [Deployed Application](#deployed-application)
- [Contributing](#contributing)

## Features

- **Remove Background:** Remove the background from an image.
- **Cleanup:** Clean up images using advanced image processing techniques.
- **Image Upscaling:** Increase the resolution of an image.
- **Text to Image:** Generate an image from a text prompt.
- **Crop Image:** Crop an image with specified dimensions and positions.
- **Replace Background:** Replace the background of an image.

## Getting Started

### Prerequisites

Before running the Image Editor, ensure you have the following installed:

- PHP
- Composer
- ClipDrop API Key

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/Hazhee/ImageEditor.git
    ```

2. Change into the project directory:

    ```bash
    cd ImageEditor
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Set up your environment variables by creating a copy of the `.env.example` file:

    ```bash
    cp .env.example .env
    ```

5. Update the `.env` file with your ClipDrop API key:

    ```env
    CLIPDROP_API_KEY=your-api-key
    ```
    You can claim 100 points along with an api key from Clipdrop by making an account (https://clipdrop.co)

6. Generate an application key:

    ```bash
    php artisan key:generate
    ```

7. Run the application:

    ```bash
    php artisan serve
    ```

   The application will be accessible at [http://localhost:8000](http://localhost:8000).

## Usage

### Remove Background

To remove the background from an image:

1. Visit [http://localhost:8000/background/remove](http://localhost:8000/background/remove).
2. Upload an image.
3. The original image to process. It should be a PNG, a JPG or a WEBP file, with a maximum resolution of 25 megapixels and a max file size of 30 Mb.
5. Optionally, specify width, height, and rotation angle.
6. Click "Remove Background."

### Cleanup

To clean up an image:

1. Visit [http://localhost:8000/cleanup](http://localhost:8000/cleanup).
2. Upload an image and a mask.
3. The original image should be a JPG or a PNG, with a maximum resolution of 16 megapixels and a max file size of 30 Mb.
4. The mask image should be a PNG, and should have the same resolution as the original image and a max file size of 30 Mb. The mask should be black and white with no grey pixels (e.g. values of only 0 or 255), the value of 0 indicating a pixel to keep as is and 255 a pixel to 'clean up'
5. Click "Cleanup."

#### Examples of input and outputs. you may use the following image along with its mask to test.
#### image_file

![Example Image](https://static.clipdrop.co/web/apis/cleanup/photo.jpg)

#### mask_file

![Example Image](https://static.clipdrop.co/web/apis/cleanup/mask.png)

### Image Upscaling

To upscale an image:

1. Visit [http://localhost:8000/image/upscaling](http://localhost:8000/image/upscaling).
2. Upload an image.
3. The original image should be a PNG, JPEG or WebP file, with a maximum resolution of 16 megapixels and a max file size of 30 Mb.
4. Optionally, specify width, height, and rotation angle.
5. Click "Upscale Image."

### Text to Image

To generate an image from text:

1. Visit [http://localhost:8000/text/to/image](http://localhost:8000/text/to/image).
2. Enter a prompt.
3. A required prompt text field describing the desired image, with a max length of a 1000 characters.
4. Click "Generate Image."

### Crop Image

To crop an image:

1. Visit [http://localhost:8000/crop/image](http://localhost:8000/crop/image).
2. Upload an image.
3. Specify width, height, x-position, y-position, and rotation angle.
4. Click "Crop Image."

### Replace Background

To replace the background of an image:

1. Visit [http://localhost:8000/replace/image/background](http://localhost:8000/replace/image/background).
2. Upload an image.
3. The input image should be a PNG, a JPG or a WEBP file, with a maximum width and height of 2048 pixels and a max file size of 20 Mb.
4. A required prompt text field describing the scene you want to teleport your item to. The value of this field can be an empty string, in which case we will generate a scene based on your item.
5. Optionally, specify width, height, and rotation angle.
6. Click "Replace Background."


## Deployed Application and Process

### Set Up Hosting Environment

### Heroku:
1. Create a Heroku account and install the Heroku CLI.
2. Initialize a Git repository if not done already: `git init`.
3. Create a Procfile in your project root with the command to start your app: `web: vendor/bin/heroku-php-apache2 public/`.
4. Commit the changes and push to Heroku:
   ```bash
   git add .
   git commit -m "Initial commit for Heroku"
   heroku create
   git push heroku main

### Configure Environment Variables
In your Heroku dashboard, under the "Settings" tab, add your environment variables (e.g., APP_KEY, API keys).

### The deployed link
The deployed version of the application can be accessed at (https://elijahimageeditor-9687250f9a6e.herokuapp.com).


## Contributing

If you'd like to contribute, feel free to fork the repository, make changes, and create a pull request. For bug reports or feature requests, please open an issue.


Enjoy using the Image Editor!

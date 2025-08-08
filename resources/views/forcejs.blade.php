<noscript>
    <style>
        html,
        body {
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        #js-disabled-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            /* 50% opacity */
            backdrop-filter: blur(8px);
            /* Blur effect */
            -webkit-backdrop-filter: blur(8px);
            color: #ffffff;
            font-family: 'Segoe UI', Roboto, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            z-index: 9999;
            padding: 2rem;
        }

        #js-disabled-content {
            background-color: rgba(20, 52, 164, 0.85);
            /* Semi-transparent box */
            padding: 2rem;
            border-radius: 10px;
            max-width: 500px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        #js-disabled-content h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        #js-disabled-content p {
            font-size: 1.125rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        #js-disabled-content a {
            display: inline-block;
            background-color: #ffffff;
            color: #1434a4;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        #js-disabled-content a:hover {
            background-color: #f0f0f0;
        }

        #js-disabled-content svg {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
        }

        #js-disabled-content svg path {
            fill: #ffffff;
        }
    </style>

    <div id="js-disabled-overlay">
        <div id="js-disabled-content">
            <svg viewBox="0 0 24 24">
                <path
                    d="M3,3H21V21H3V3M7.73,18.04C8.13,18.89 8.92,19.59 10.27,19.59C11.77,19.59 12.8,18.79 12.8,17.04V11.26H11.1V17C11.1,17.86 10.75,18.08 10.2,18.08C9.62,18.08 9.38,17.68 9.11,17.21L7.73,18.04M13.71,17.86C14.21,18.84 15.22,19.59 16.8,19.59C18.4,19.59 19.6,18.76 19.6,17.23C19.6,15.82 18.79,15.19 17.35,14.57L16.93,14.39C16.2,14.08 15.89,13.87 15.89,13.37C15.89,12.96 16.2,12.64 16.7,12.64C17.18,12.64 17.5,12.85 17.79,13.37L19.1,12.5C18.55,11.54 17.77,11.17 16.7,11.17C15.19,11.17 14.22,12.13 14.22,13.4C14.22,14.78 15.03,15.43 16.25,15.95L16.67,16.13C17.45,16.47 17.91,16.68 17.91,17.26C17.91,17.74 17.46,18.09 16.76,18.09C15.93,18.09 15.45,17.66 15.09,17.06L13.71,17.86Z" />
            </svg>
            <h1>JavaScript is Disabled</h1>
            <p>To continue using the site properly, please enable JavaScript in your browser settings.</p>
            <a href="https://www.enable-javascript.com/" target="_blank" rel="noopener">Enable JavaScript</a>
        </div>
    </div>
</noscript>

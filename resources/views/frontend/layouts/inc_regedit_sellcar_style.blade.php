<style>
    .step {
        display: none;
    }
    .step.active {
        display: block;
    }


    .box-waiting {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.5); /* Black background with 50% opacity */
        z-index: 999; /* Set z-index to 999 */
    }

    .waiting-wrapper-image {
        width: 100%;
        max-width: 400px;
        height: 0;
        padding-bottom: 11.1111%;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .waiting-wrapper-image img {
        width: 120px; /* Set the width to 120px */
        height: auto; /* Automatically adjust the height to maintain aspect ratio */
        max-width: 100%; /* Ensure the image doesn't exceed its container */
    }

    
    




    .item-photoupload {
        background-color: #ddd; /* Add background color */
        padding: 10px;
        margin: 5px;
        border-radius: 5px;
        position: relative;
        border: 1px solid #ddd;
        overflow: hidden; /* Ensure spinner or loader does not overflow */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .item-photoupload.loading .spinner {
        width: 30px; /* Adjust size of spinner */
        height: 30px;
        position: absolute; /* Position spinner in center */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .uploaded-image {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 5px;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .col-photoupload {
        position: relative;
    }
    .wrapper-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }


    .spinner {
        width: 24px;
        height: 24px;
        display: grid;
        border-radius: 50%;
        -webkit-mask: radial-gradient(farthest-side,#0000 40%,#000000 41%);
        background: linear-gradient(0deg ,rgba(0,0,0,0.5) 50%,rgba(0,0,0,1) 0) center/1.9px 100%,
                linear-gradient(90deg,rgba(0,0,0,0.25) 50%,rgba(0,0,0,0.75) 0) center/100% 1.9px;
        background-repeat: no-repeat;
        animation: spinner-d3o0rx 1s infinite steps(12);
        }

        .spinner::before,
        .spinner::after {
        content: "";
        grid-area: 1/1;
        border-radius: 50%;
        background: inherit;
        opacity: 0.915;
        transform: rotate(30deg);
        }

        .spinner::after {
        opacity: 0.83;
        transform: rotate(60deg);
        }

        @keyframes spinner-d3o0rx {
        100% {
            transform: rotate(1turn);
        }
    }


    










    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 45px;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 9px;
        right: 12px;
        width: 20px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 43px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        display: block;
        padding-left: 17px;
        padding-right: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

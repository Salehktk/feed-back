function toggleComments(icon) {
    const commentsContainer = icon.parentElement.querySelector(".comments");
    commentsContainer.style.display =
        commentsContainer.style.display === "none" ||
        commentsContainer.style.display === ""
            ? "block"
            : "none";
}

document.addEventListener("trix-file-accept", function (e) {
    e.preventDefault();
});

// Sample list of users
const users = ["user1", "user2", "user3", "user4", "user5"];

const commentContent = document.getElementById("comment-content");
const userList = document.getElementById("user-list");

commentContent.addEventListener("input", handleInput);

function handleInput() {
    const content = commentContent.value;
    const startIndex = content.lastIndexOf("@");

    if (startIndex !== -1) {
        const query = content.substring(startIndex + 1);

        // Filter users based on the query
        const filteredUsers = users.filter((user) =>
            user.toLowerCase().includes(query.toLowerCase())
        );

        // Display the user suggestions
        showUserSuggestions(filteredUsers);
    } else {
        // Hide the user suggestions if "@" is not present
        hideUserSuggestions();
    }
}

function showUserSuggestions(userSuggestions) {
    userList.innerHTML = "";

    if (userSuggestions.length > 0) {
        userSuggestions.forEach((user) => {
            const userOption = document.createElement("div");
            userOption.className = "user-option";
            userOption.textContent = user;

            userOption.addEventListener("click", () => {
                insertMention(user);
                hideUserSuggestions();
            });

            userList.appendChild(userOption);
        });

        userList.style.display = "block";
    } else {
        hideUserSuggestions();
    }
}

function hideUserSuggestions() {
    userList.style.display = "none";
}

function insertMention(username) {
    const content = commentContent.value;
    const startIndex = content.lastIndexOf("@");

    if (startIndex !== -1) {
        const mentionText = `@${username} `;
        const updatedContent =
            content.substring(0, startIndex) +
            mentionText +
            content.substring(startIndex + username.length + 1);
        commentContent.value = updatedContent;
    }
}

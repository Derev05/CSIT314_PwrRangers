// UserBoundary.js
document.addEventListener('DOMContentLoaded', () => {
    new UserBoundary();
});

class UserBoundary {
    constructor() {
        this.form = document.querySelector('#addUserForm');
        this.init();
    }

    init() {
        this.setMaxDateForDOB();
        this.setupFormSubmit();
        this.loadUsers();
        this.setupEventListeners();
    }

    setMaxDateForDOB() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('dob').setAttribute('max', today);
    }

    displayMessage(message) {
        alert(message);
    }

    setupFormSubmit() {
        this.form.addEventListener('submit', (event) => {
            event.preventDefault();
            const formData = new FormData(this.form);
            formData.append('isSuspended', document.getElementById('isSuspended').checked ? 1 : 0);

            if (document.getElementById('userId').value) {
                this.updateUserAccount(formData);
            } else {
                this.createUserAccount(formData);
            }
        });
    }

    createUserAccount(formData) {
        fetch('UserCreationController.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.displayMessage('User added successfully!');
                    location.reload();
                } else {
                    this.displayMessage('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    updateUserAccount(formData) {
        fetch('UserUpdateController.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.displayMessage('User updated successfully!');
                    location.reload();
                } else {
                    this.displayMessage('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    loadUsers(query = '') {
        fetch('SearchUserController.php?query=' + query)
            .then(response => response.json())
            .then(data => {
                let table = $('#userTable').DataTable();
                table.clear().draw();
                data.forEach(user => {
                    const statusText = user.is_suspended == 1 ? "Suspend" : "Active";
                    const statusClass = user.is_suspended == 1 ? 'text-danger' : 'text-success';
                    table.row.add([
                        user.username,
                        '********',
                        user.email,
                        user.contactno,
                        user.dob,
                        user.role,
                        user.created_at,
                        `<span class="${statusClass}">${statusText}</span>`,
                        `<div class="d-flex gap-2">
                            <button class="btn btn-primary btn-sm edit-user" data-id="${user.id}">Edit</button>
                            <button class="btn btn-warning btn-sm suspend-user" data-id="${user.id}">Suspend</button>
                        </div>`
                    ]).draw(false);
                });
            })
            .catch(error => {
                console.error("Error loading users:", error);
            });
    }

    suspendUserAccount(userId) {
        if (confirm("Are you sure you want to suspend this user?")) {
            fetch('UserSuspendController.php?id=' + userId, { method: 'GET' })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.displayMessage('User suspended successfully!');
                        location.reload();
                    } else {
                        this.displayMessage('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error suspending user:", error);
                });
        }
    }

    openEditModal(user) {
        document.getElementById('userId').value = user.id;
        document.getElementById('username').value = user.username;
        document.getElementById('password').value = user.password;
        document.getElementById('contactno').value = user.contactno;
        document.getElementById('email').value = user.email;
        document.getElementById('dob').value = user.dob;
        document.getElementById('role').value = user.role;
        document.getElementById('isSuspended').checked = user.is_suspended == 1;

        const userModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
        userModal.show();
    }

    setupEventListeners() {
        document.getElementById('addUserBtn').addEventListener('click', () => {
            document.getElementById('addUserForm').reset();
            document.getElementById('addEmployeeModalLabel').textContent = 'Add Info';
            document.getElementById('userId').value = '';
        });

        document.addEventListener('click', (event) => {
            const target = event.target;

            if (target.classList.contains('edit-user')) {
                const userId = target.getAttribute('data-id');
                fetch('UserFetchController.php?id=' + userId)
                    .then(response => response.json())
                    .then(userData => {
                        if (userData && !userData.error) {
                            this.openEditModal(userData);
                        } else {
                            console.error('Error: ' + (userData.error || 'User data not found'));
                        }
                    })
                    .catch(error => console.error('Error fetching user data:', error));
			}
			
			if (target.classList.contains('suspend-user')) {
                this.suspendUserAccount(target.getAttribute('data-id'));
            }
            
        });

        document.querySelector('#searchUser').addEventListener('input', () => {
            this.loadUsers(document.querySelector('#searchUser').value);
        });

        $(document).ready(() => {
            const table = $('#userTable').DataTable({ pageLength: 10, searching: false });
            $('#searchUser').on('keyup', () => table.search($('#searchUser').val()).draw());
        });
    }
}

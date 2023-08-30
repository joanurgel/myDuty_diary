<script>
    function confirmDeleteDiary(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            imageUrl: "{{ asset("assets/icon/dogs.jpg") }}", // Replace this with the actual image URL
            imageHeight: 200,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#005',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send an AJAX request to delete the user
                axios.delete(`/diaries/${userId}`)
                    .then(response => {
                        // Handle the success response from the server
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        // Optionally, you can update the UI or reload the page after successful deletion
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                         
                    }) 
                    .catch(error => {
                        // Handle the error response from the server
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the user.',
                            'error'
                        );
                    });
            }
        });
    }
</script>
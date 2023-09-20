$(document).ready(function(){

    // Delete Category
    $(document).on('click','.btn-delete',function(event){
        console.log("in script");
        event.preventDefault();
        let status = confirm("Are you sure to delete?");
    if(status)
   {
    let id=$(this).parent().attr('id');
    $.ajax({
    method:'post',
    url:'delete_category.php',
    data:{id:id},
    success:function(response){
        if(response == 'success')
        {
            alert("Successfullly deleted")
            location.href='category.php'
        }
        else{
            alert(response)
        }

    },
    error:function(error)
    {
        alert(error)
    }
    })
   }
       
    })

    // Delete Course
    $(document).on('click','.cbtn_delete',function(event){
        console.log("in script");
        event.preventDefault();
        let status = confirm("Are you sure to delete?");
       if(status)
   {
    let id=$(this).parent().attr('id');
    $.ajax({
    method:'post',
    url:'delete_course.php',
    data:{id:id},
    success:function(response){
        if(response == 'success')
        {
            alert("Successfullly deleted")
            location.href='course.php'
        }
        else{
            alert(response)
        }

    },
    error:function(error)
    {
        alert(error)
    }
    })
    }  
    })

    // Delete Instructor
    $(document).on('click','.ibtn_delete',function(event){
        event.preventDefault();
        let status = confirm("Are you sure to delete?");
        if(status){
            let id=$(this).parent().attr('id');
            $.ajax({
                method: 'post',
                url: 'delete_instructor.php',
                data: {id:id},
                success:function(response){
                    if(response == 'success'){
                        alert("Successfully deleted")
                        location.href= 'instructor.php'
                    } else {
                        alert(response)
                    }
                },
                error:function(error){
                    alert(error)
                }
            })
        }
    })

    //Delete Trainee
    $(document).on('click','.tbtn_delete',function(event){
        console.log("In script");
        event.preventDefault();
        let status = confirm("Are you sure to delete?");
        if(status){
            let id=$(this).parent().attr('id');
            $.ajax({
                method: 'post',
                url: 'delete_trainee.php',
                data: {id:id},
                success:function(response){
                    if(response == 'success'){
                        alert("Successfully deleted");
                        location.href= 'trainee.php'
                    } else{
                        alert(response);
                    }
                },
                error:function(error){
                    alert(error);
                }
            })
        }
    })


   // Delete Batch
   $(document).on('click','.bbtn_delete',function(event){
    event.preventDefault();
    let status = confirm("Are you sure to delete?");
    if(status){
        let id=$(this).parent().attr('id')
        $.ajax({
            method: 'post',
            url: 'delete_batch.php',
            data:{id:id},
            success:function(response){
                if(response == 'success'){
                    alert("Successfully deleted")
                    location.href = 'batch.php'
                } else {
                    alert(response)
                }
            },
            error:function(error){
                alert(error)
            }
        })
    }
   })

   //Delete Batch Trainee
   $(document).on('click','.batrbtn_delete',function(event){
    console.log("In script")
    event.preventDefault();
    console.log("Btn is clicked")
    let status = confirm("Are you sure to delete?");
    if(status){
        let id=$(this).parent().attr('id')
        $.ajax({
            method: 'post',
            url: 'delete_registeration.php',
            data:{id:id},
            success:function(response){
                if(response == 'success'){
                    alert("Successfully deleted")
                    location.href = 'batchTrainee.php'
                } else {
                    alert(response)
                }
            },
            error:function(error){
                alert(error)
            }
        })
    }
    });

    //Email Batch Trainee
    // $(document).on('click','.mail_register',function(event){
    //     console.log("In script")
    //     event.preventDefault();
    //     console.log("Btn is clicked")
        // let status = confirm("Send Mail");
        // if(status){
        //     let id=$(this).parent().attr('id')
        //     $.ajax({
        //         method: 'post',
        //         url: 'emailBatchTrainee.php',
        //         data:{id:id},
        //         success:function(response){
        //             if(response == 'success'){
        //                 alert("Successfully mailed")
        //                 location.href = 'batchTrainee.php'
        //             } else {
        //                 alert(response)
        //             }
        //         },
        //         error:function(error){
        //             alert(error)
        //         }
        //     })
        // }
        //});
    


    $('#mytable').DataTable();
    
    $.ajax({
        url:'report_chart.php',
        method: 'post',
        success:function(response)
        {
            let batch = JSON.parse(response)
            console.log(batch)
            let year =[];
            let data =[];
            for (let index=0;index<batch.length; index++)
            {
                year[index] = batch[index].year;
                data[index] = batch[index].total;
            }
            console.log(year);
            console.log(data);
            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
		var gradient = ctx.createLinearGradient(0, 0, 0, 225);
		gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
		gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
		// Line chart
		new Chart(document.getElementById("chartjs-dashboard-line"), {
			type: "line",
			data: {
                //x coordinate
				labels: ["2017","2018","2019","2020","2021","2022","2023"],
				datasets: [{
					label: "Batches",
					fill: true,
					backgroundColor: gradient,
					borderColor: window.theme.primary,
					data: data
				}]
			},
			options: {
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				tooltips: {
					intersect: false
				},
				hover: {
					intersect: true
				},
				plugins: {
					filler: {
						propagate: false
					}
				},
				scales: {
					xAxes: [{
						reverse: true,
						gridLines: {
							color: "rgba(0,0,0,0.0)"
						}
					}],
					yAxes: [{
						ticks: {
							stepSize: 2
						},
						display: true,
						borderDash: [3, 3],
						gridLines: {
							color: "rgba(0,0,0,0.0)"
						}
					}]
				}
			}
		});
          
        },
        error:function(message)
        {

        }
    })

    $(document).on('click','.addbtn',function(event){
        event.preventDefault();
        console.log("btn click")
        let id=$(this).parent().attr('id')
        console.log(id)
        $.ajax({
            url:'get_trainee.php',
            method:'post',
            data:{id:id},
            success:function(response){
                $('.rows').append(response)
            },
            error:function(response)
            {
                
            }
        }) 
        // $('#removebtn').on('click',function(event){
        //     event.preventDefault();
        //     console.log("btn remove");    
        //     $(this).parent().remove()
        // })
    })
    $(document).on('click','#removebtn',function(event){
        event.preventDefault();
        console.log("btn remove");    
        $(this).parent().remove()          
    })
})



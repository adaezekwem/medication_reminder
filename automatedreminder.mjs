import cron from 'node-cron';
import nodemailer from 'nodemailer';
import axios from 'axios';
import { readFileSync } from 'fs';

// Load the user email from the file
const userFilePath = 'user_email.txt';
const userEmailAddress = readFileSync(userFilePath, 'utf-8');

// Create a reusable transporter object using SMTP transport
const transporter = nodemailer.createTransport({
  service: 'Gmail', // or your email service provider
  auth: {
    user: 'michelleezekwem@gmail.com', // Replace with your email
    pass: 'mnqkettalfbrymdn' // Replace with your email password or an app password
  }
});

function processSchedules() {
  console.log('Processing schedules...');
  // Read JSON schedules content from the file
  const jsonSchedulesFilePath = 'jsonSchedules.txt';
  const jsonSchedulesContent = readFileSync(jsonSchedulesFilePath, 'utf-8');
  
  try {
    // Parse the JSON schedules content into a JavaScript object
    const jsonSchedules = JSON.parse(jsonSchedulesContent);
  
    // Convert nested Unix timestamps to JavaScript Date objects
    const nestedUnixTimestamps = jsonSchedules.map(schedule => schedule.map(timestamp => new Date(timestamp)));
    
    // Flatten the nested array and convert Unix timestamps to JavaScript Date objects
    const jsDateSchedules = nestedUnixTimestamps.flat();
    console.log(jsDateSchedules);
    
    // Rest of your code to process the schedules
    const currentTime = new Date();
    console.log('Current Time:', currentTime);
    jsDateSchedules.forEach(medicationTime => {
      
      if (Math.abs(medicationTime.getTime() - currentTime.getTime()) <= 60000) {
        console.log('Matching time found:', medicationTime);
        const mailOptions = {
          from: 'michelleezekwem@gmail.com',
          to: userEmailAddress,
          subject: 'Medication Reminder',
          text: 'It\'s time to take your medication.'
        };
  
        // Send email
        transporter.sendMail(mailOptions, (error, info) => {
          if (error) {
            console.log('Error sending email:', error);
          } else {
            console.log('Email sent:', info.response);
          }
        });
      }
    });
  } catch (error) {
    console.error('Error parsing JSON:', error);
  }
}
console.log('Script started.');
// Schedule the processSchedules function to run every minute
const intervalInMilliseconds = 60 * 1000; // 1 minute
setInterval(processSchedules, intervalInMilliseconds);
console.log('Interval set.');
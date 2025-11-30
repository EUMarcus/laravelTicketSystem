<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding tickets/reports...');

        // Create or get sample users and profiles
        $customers = $this->createSampleCustomers();
        $employees = $this->createSampleEmployees();

        $tickets = [
            [
                'customer' => $customers[0],
                'subject' => 'Broken Streetlight on Main Street',
                'description' => 'There is a broken streetlight on Main Street near the intersection with Oak Avenue. It has been out for over a week now, making the area dark and unsafe at night. This is a safety concern, especially for pedestrians and residents walking home in the evening. Please send someone to repair or replace the streetlight as soon as possible.',
                'status' => 'open',
                'priority' => 'high',
                'assigned_employee' => null,
            ],
            [
                'customer' => $customers[1],
                'subject' => 'Garbage Collection Issue',
                'description' => 'The garbage collection truck has been missing our street for the past two weeks. We have been following the schedule, but the truck does not come. The garbage is piling up and creating an unpleasant smell. This is also attracting stray animals. Please investigate and ensure regular garbage collection is resumed.',
                'status' => 'in_progress',
                'priority' => 'urgent',
                'assigned_employee' => $employees[0],
            ],
            [
                'customer' => $customers[2],
                'subject' => 'Pothole on Community Road',
                'description' => 'There is a large pothole on Community Road, approximately 50 meters from the barangay hall. It has been getting bigger with each rain and is now causing damage to vehicles. Several residents have reported flat tires due to this pothole. Please repair this road hazard immediately to prevent further damage and accidents.',
                'status' => 'open',
                'priority' => 'high',
                'assigned_employee' => null,
            ],
            [
                'customer' => $customers[0],
                'subject' => 'Noisy Construction Work',
                'description' => 'There is ongoing construction work in the neighborhood that starts very early in the morning (around 5:00 AM) and continues late into the evening. The noise is disturbing residents, especially those who work night shifts or have young children. Can we request that construction hours be limited to reasonable times, such as 7:00 AM to 6:00 PM?',
                'status' => 'resolved',
                'priority' => 'medium',
                'assigned_employee' => $employees[1],
                'resolved_at' => Carbon::now()->subDays(2),
            ],
            [
                'customer' => $customers[3],
                'subject' => 'Water Supply Interruption',
                'description' => 'Our area has been experiencing frequent water supply interruptions for the past month. The water pressure is also very low when it does come. This is affecting daily activities like cooking, cleaning, and personal hygiene. Please investigate the water system and ensure consistent water supply.',
                'status' => 'in_progress',
                'priority' => 'urgent',
                'assigned_employee' => $employees[0],
            ],
            [
                'customer' => $customers[1],
                'subject' => 'Request for Speed Bumps',
                'description' => 'I would like to request the installation of speed bumps on Elm Street. Many vehicles are speeding through this residential area, which is dangerous for children playing and residents walking. There have been several near-miss accidents. Speed bumps would help slow down traffic and make our street safer.',
                'status' => 'open',
                'priority' => 'medium',
                'assigned_employee' => null,
            ],
            [
                'customer' => $customers[2],
                'subject' => 'Stray Dogs in the Neighborhood',
                'description' => 'There are several stray dogs roaming the neighborhood that have become aggressive. They are causing concern for residents, especially those with small children. Some dogs have been seen chasing people and other pets. Please help address this issue by either relocating the dogs or finding a solution to ensure community safety.',
                'status' => 'open',
                'priority' => 'high',
                'assigned_employee' => null,
            ],
            [
                'customer' => $customers[3],
                'subject' => 'Damaged Sidewalk',
                'description' => 'The sidewalk along Pine Street is damaged and has uneven concrete slabs. This is a tripping hazard, especially for elderly residents and people with mobility issues. Several people have already tripped and fallen. Please repair the sidewalk to ensure pedestrian safety.',
                'status' => 'resolved',
                'priority' => 'medium',
                'assigned_employee' => $employees[1],
                'resolved_at' => Carbon::now()->subDays(5),
            ],
            [
                'customer' => $customers[0],
                'subject' => 'Flooding During Heavy Rain',
                'description' => 'Our street floods every time there is heavy rain. The drainage system seems to be clogged or insufficient. Water accumulates quickly and sometimes enters homes. This has been an ongoing issue that gets worse each year. Please inspect and improve the drainage system in our area.',
                'status' => 'in_progress',
                'priority' => 'high',
                'assigned_employee' => $employees[0],
            ],
            [
                'customer' => $customers[1],
                'subject' => 'Request for Street Cleaning',
                'description' => 'The street in front of our house has accumulated a lot of debris, leaves, and dirt. It has not been cleaned in several months. This is not only unsightly but also a health concern. Please schedule a street cleaning for our area.',
                'status' => 'open',
                'priority' => 'low',
                'assigned_employee' => null,
            ],
            [
                'customer' => $customers[2],
                'subject' => 'Loud Music from Neighbor',
                'description' => 'A neighbor has been playing very loud music late into the night, sometimes until 2:00 AM. This is disturbing the peace and affecting the sleep of nearby residents. We have tried talking to them, but the issue persists. Can the barangay help mediate this situation?',
                'status' => 'open',
                'priority' => 'medium',
                'assigned_employee' => null,
            ],
            [
                'customer' => $customers[3],
                'subject' => 'Missing Street Sign',
                'description' => 'The street sign for Maple Avenue is missing. This makes it difficult for visitors, delivery services, and emergency responders to locate addresses. Please install a new street sign to replace the missing one.',
                'status' => 'closed',
                'priority' => 'low',
                'assigned_employee' => $employees[1],
                'resolved_at' => Carbon::now()->subDays(10),
            ],
            [
                'customer' => $customers[0],
                'subject' => 'Request for Community Park Maintenance',
                'description' => 'The community park needs maintenance. The playground equipment is rusty and some parts are broken. The grass is overgrown, and there are broken benches. This park is important for families and children. Please schedule maintenance and repairs to make it safe and usable again.',
                'status' => 'open',
                'priority' => 'medium',
                'assigned_employee' => null,
            ],
            [
                'customer' => $customers[1],
                'subject' => 'Illegal Parking on Sidewalk',
                'description' => 'Vehicles are frequently parking on the sidewalk, blocking pedestrian access. This forces people to walk on the road, which is dangerous. This happens especially during weekends. Please enforce parking regulations and ensure sidewalks remain accessible to pedestrians.',
                'status' => 'in_progress',
                'priority' => 'medium',
                'assigned_employee' => $employees[0],
            ],
            [
                'customer' => $customers[2],
                'subject' => 'Request for Additional Streetlights',
                'description' => 'The area around the community center is poorly lit at night. This creates safety concerns for residents attending evening activities or walking home. Please install additional streetlights to improve visibility and security in this area.',
                'status' => 'open',
                'priority' => 'medium',
                'assigned_employee' => null,
            ],
        ];

        foreach ($tickets as $ticketData) {
            try {
                $ticket = Ticket::create([
                    'id' => (string) Str::uuid(),
                    'customer_id' => $ticketData['customer']->id,
                    'assigned_employee_id' => $ticketData['assigned_employee']?->id,
                    'subject' => $ticketData['subject'],
                    'description' => $ticketData['description'],
                    'status' => $ticketData['status'],
                    'priority' => $ticketData['priority'],
                    'resolved_at' => $ticketData['resolved_at'] ?? null,
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                    'updated_at' => Carbon::now()->subDays(rand(0, 5)),
                ]);

                $this->command->info('✓ Created: ' . $ticketData['subject']);
            } catch (\Exception $e) {
                $this->command->error('✗ Failed to create: ' . $ticketData['subject']);
                $this->command->error('  Error: ' . $e->getMessage());
            }
        }

        $this->command->info('Ticket seeding completed!');
    }

    /**
     * Create sample customer profiles
     */
    private function createSampleCustomers(): array
    {
        $customers = [];
        $customerData = [
            ['name' => 'Maria Santos', 'email' => 'maria.santos@example.com'],
            ['name' => 'Juan Dela Cruz', 'email' => 'juan.delacruz@example.com'],
            ['name' => 'Ana Garcia', 'email' => 'ana.garcia@example.com'],
            ['name' => 'Carlos Rivera', 'email' => 'carlos.rivera@example.com'],
        ];

        foreach ($customerData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'id' => (string) Str::uuid(),
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'voters_id' => strtoupper(Str::random(22)),
                    'contact_number' => '09' . rand(100000000, 999999999),
                    'address' => 'Sample Address, Barangay',
                ]
            );

            $profile = Profile::firstOrCreate(
                ['id' => $user->id],
                [
                    'role' => 'customer',
                    'name' => $data['name'],
                ]
            );

            $customers[] = $profile;
        }

        return $customers;
    }

    /**
     * Create sample employee profiles
     */
    private function createSampleEmployees(): array
    {
        $employees = [];
        $employeeData = [
            ['name' => 'Roberto Mendoza', 'email' => 'roberto.mendoza@barangay.gov'],
            ['name' => 'Liza Fernandez', 'email' => 'liza.fernandez@barangay.gov'],
        ];

        foreach ($employeeData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'id' => (string) Str::uuid(),
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'voters_id' => strtoupper(Str::random(22)),
                    'contact_number' => '09' . rand(100000000, 999999999),
                    'address' => 'Barangay Hall',
                ]
            );

            $profile = Profile::firstOrCreate(
                ['id' => $user->id],
                [
                    'role' => 'employee',
                    'name' => $data['name'],
                ]
            );

            $employees[] = $profile;
        }

        return $employees;
    }
}

